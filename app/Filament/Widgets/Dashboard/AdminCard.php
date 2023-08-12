<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Donation;
use App\Models\Requisition;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminCard extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = -3;

    /**
     * @var view-string
     */
    protected static string $view = 'filament-panels::widgets.account-widget';
}
