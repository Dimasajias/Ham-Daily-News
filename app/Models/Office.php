<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'tempat_kedudukan'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function getTimezoneAttribute(): string
    {
        $wita = ['SULSEL', 'SULBAR', 'SULTENG', 'SULTRA', 'SULUT', 'GORONTALO', 'BALI', 'NTB', 'NTT', 'KALSEL', 'KALTIM', 'KALTARA'];
        $wit = ['MALUKU', 'MALUT', 'PAPUA', 'PAPBAR'];

        if (in_array($this->code, $wita)) {
            return 'Asia/Makassar'; // WITA
        }

        if (in_array($this->code, $wit)) {
            return 'Asia/Jayapura'; // WIT
        }

        return 'Asia/Jakarta'; // WIB (Default)
    }
}
