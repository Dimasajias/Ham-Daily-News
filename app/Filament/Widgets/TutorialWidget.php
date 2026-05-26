<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TutorialWidget extends Widget
{
    protected static string $view = 'filament.widgets.tutorial-widget';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 10;
}
