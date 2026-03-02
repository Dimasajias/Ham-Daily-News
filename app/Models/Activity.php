<?php

namespace App\Models;

use App\Enums\ActivityStatus;
use App\Enums\Platform;
use App\Enums\Unit;
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

        'unit',
        'social_media_url',
        'platform',
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
            'status' => ActivityStatus::class,
            'platform' => Platform::class,
            'unit' => Unit::class,
            'approved_at' => 'datetime',
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

    // ──── Helpers ────

    public function approve(User $admin): void
    {
        $this->update([
            'status' => ActivityStatus::Approved,
            'approved_by' => $admin->id,
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);
    }

    public function reject(User $admin, string $reason): void
    {
        $this->update([
            'status' => ActivityStatus::Rejected,
            'approved_by' => $admin->id,
            'approved_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }
}
