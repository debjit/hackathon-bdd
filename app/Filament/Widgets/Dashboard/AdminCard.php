<?php

namespace App\Filament\Widgets\Dashboard;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AdminCard extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -3;

    /**
     * @var view-string
     */
    protected static string $view = 'filament-panels::widgets.account-widget';
}
