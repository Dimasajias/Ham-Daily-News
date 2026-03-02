<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Unit: string implements HasLabel
{
    case SETJEN = 'setjen';
    case ITJEN = 'itjen';
    case DIT_PDK = 'dit_pdk';
    case DIT_IDP = 'dit_idp';

    public function label(): string
    {
        return match ($this) {
            self::SETJEN => 'SETJEN',
            self::ITJEN => 'ITJEN',
            self::DIT_PDK => 'DIT PDK',
            self::DIT_IDP => 'DIT IDP',
        };
    }

    public function getLabel(): ?string
    {
        return $this->label();
    }
}
