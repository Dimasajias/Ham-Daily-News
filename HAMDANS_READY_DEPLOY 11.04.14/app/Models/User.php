<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'office_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ──── Filament ────

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // All authenticated users can access the panel
    }

    // ──── Relationships ────

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    // ──── Helpers ────

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isRegional(): bool
    {
        return $this->hasRole('regional');
    }
}
