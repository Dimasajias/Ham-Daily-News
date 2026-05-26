<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtpCode extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'expires_at',
        'used_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'used_at'    => 'datetime',
        ];
    }

    // ──── Relationships ────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ──── Helpers ────

    /**
     * Cek apakah OTP sudah expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Cek apakah OTP sudah digunakan.
     */
    public function isUsed(): bool
    {
        return $this->used_at !== null;
    }

    /**
     * Cek apakah OTP masih valid (belum expired & belum digunakan).
     */
    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->isUsed();
    }

    /**
     * Tandai OTP sebagai sudah digunakan.
     */
    public function markAsUsed(): void
    {
        $this->update(['used_at' => now()]);
    }

    /**
     * Generate OTP baru untuk user tertentu.
     */
    public static function generateFor(User $user): self
    {
        // Hapus semua OTP lama user ini yang belum digunakan
        static::where('user_id', $user->id)
            ->whereNull('used_at')
            ->delete();

        // Generate kode 6 digit
        $plainCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan dengan hash
        $otp = static::create([
            'user_id'    => $user->id,
            'code'       => bcrypt($plainCode),
            'expires_at' => now()->addMinutes(5),
        ]);

        // Simpan plain code sementara untuk dikirim via email
        $otp->plain_code = $plainCode;

        return $otp;
    }

    /**
     * Verifikasi kode OTP yang diinput user.
     */
    public static function verifyFor(User $user, string $inputCode): bool
    {
        $otp = static::where('user_id', $user->id)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            return false;
        }

        if (\Illuminate\Support\Facades\Hash::check($inputCode, $otp->code)) {
            $otp->markAsUsed();
            return true;
        }

        return false;
    }
}
