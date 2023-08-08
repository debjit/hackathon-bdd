<?php

namespace App\Filament\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // protected static ?string $title = 'Home';
    public function getTitle(): string | Htmlable
    {
        return __('Home');
    }
    // Customize properties or methods here
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
}
