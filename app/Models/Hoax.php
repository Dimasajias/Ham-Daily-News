<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hoax extends Model
{
    use HasFactory;

    protected $table = 'hoaxes';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'source_url',
        'cover_image',
        'category',
        'verdict',
        'is_published',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    // ──── Relationships ────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ──── Scopes ────

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    // ──── Helpers ────

    public function verdictLabel(): string
    {
        return match ($this->verdict) {
            'hoax'        => 'HOAX',
            'menyesatkan' => 'MENYESATKAN',
            'klarifikasi' => 'KLARIFIKASI',
            default       => strtoupper($this->verdict),
        };
    }

    public function verdictColor(): string
    {
        return match ($this->verdict) {
            'hoax'        => '#DC2626',
            'menyesatkan' => '#D97706',
            'klarifikasi' => '#16A34A',
            default       => '#6B7280',
        };
    }

    public function verdictBg(): string
    {
        return match ($this->verdict) {
            'hoax'        => 'rgba(220,38,38,0.08)',
            'menyesatkan' => 'rgba(217,119,6,0.08)',
            'klarifikasi' => 'rgba(22,163,74,0.08)',
            default       => 'rgba(107,114,128,0.08)',
        };
    }
}
