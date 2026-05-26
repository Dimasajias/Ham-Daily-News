<?php

namespace App\Models;

use App\Enums\ActivityStatus;
use App\Enums\Platform;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'office_id',

        'social_media_links',
        'extracted_title',
        'description',
        'extracted_image',
        'foto_dokumentasi',
        'status',
        'rejection_reason',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'status'             => ActivityStatus::class,
            'social_media_links' => 'array',
            'approved_at'        => 'datetime',
        ];
    }

    // ──── Relationships ────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // ──── Social Media Link Helpers ────

    /**
     * Ambil semua platform yang ada di kegiatan ini.
     *
     * @return Platform[]
     */
    public function getPlatforms(): array
    {
        $links = $this->social_media_links ?? [];
        $platforms = [];

        foreach ($links as $link) {
            $platformValue = $link['platform'] ?? 'other';
            $platform = Platform::tryFrom($platformValue);
            if ($platform && !in_array($platform, $platforms, true)) {
                $platforms[] = $platform;
            }
        }

        return $platforms;
    }

    /**
     * Ambil URL untuk platform tertentu.
     */
    public function getUrlForPlatform(Platform $platform): ?string
    {
        $links = $this->social_media_links ?? [];

        foreach ($links as $link) {
            if (($link['platform'] ?? '') === $platform->value) {
                return $link['url'] ?? null;
            }
        }

        return null;
    }

    /**
     * Cek apakah kegiatan memiliki link untuk platform tertentu.
     */
    public function hasPlatform(Platform $platform): bool
    {
        return $this->getUrlForPlatform($platform) !== null;
    }

    /**
     * Ambil URL pertama yang tersedia (fallback).
     */
    public function getFirstUrl(): ?string
    {
        $links = $this->social_media_links ?? [];
        return $links[0]['url'] ?? null;
    }

    /**
     * Ambil platform pertama yang tersedia (fallback).
     */
    public function getFirstPlatform(): ?Platform
    {
        $links = $this->social_media_links ?? [];
        $val = $links[0]['platform'] ?? null;
        return $val ? Platform::tryFrom($val) : null;
    }

    // ──── Scopes ────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', ActivityStatus::Approved);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', ActivityStatus::Pending);
    }

    public function scopeForOffice(Builder $query, int $officeId): Builder
    {
        return $query->where('office_id', $officeId);
    }

    public function scopeApplyFilters(Builder $query, \Illuminate\Http\Request $request): Builder
    {
        // Filter by office
        if ($request->filled('kanwil')) {
            $query->where('office_id', $request->kanwil);
        }

        // Filter by date range
        if ($request->filled('dari')) {
            $query->whereDate('approved_at', '>=', $request->dari);
        }

        if ($request->filled('sampai')) {
            $query->whereDate('approved_at', '<=', $request->sampai);
        }

        // Search by title
        if ($request->filled('cari')) {
            $query->where('extracted_title', 'like', '%' . $request->cari . '%');
        }

        // Filter today
        if ($request->filled('hari_ini')) {
            $query->whereDate('approved_at', today());
        }

        // Filter by platform (search in JSON array)
        if ($request->filled('platform')) {
            $platform = $request->platform;
            $query->whereRaw(
                "JSON_CONTAINS(social_media_links, JSON_OBJECT('platform', ?))",
                [$platform]
            );
        }

        return $query;
    }

    // ──── Helpers ────

    public function approve(User $admin): void
    {
        $this->update([
            'status'           => ActivityStatus::Approved,
            'approved_by'      => $admin->id,
            'approved_at'      => $this->approved_at ?? now(), // Tetap pakai tanggal lama jika sudah ada
            'rejection_reason' => null,
        ]);
    }

    public function reject(User $admin, string $reason): void
    {
        $this->update([
            'status'           => ActivityStatus::Rejected,
            'approved_by'      => $admin->id,
            // Jika sudah pernah approve, biarkan tanggalnya tetap untuk record, 
            // tapi statusnya sudah berubah jadi Rejected sehingga tidak tampil di publik.
            'approved_at'      => $this->approved_at ?? now(), 
            'rejection_reason' => $reason,
        ]);
    }
}
