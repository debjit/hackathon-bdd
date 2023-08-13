<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    // protected static ?string $title = 'Home';
    protected int|string|array $columnSpan = 'full';

    public function getTitle(): string|Htmlable
    {
        return __('Home');
    }

    // Customize properties or methods here
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
}
