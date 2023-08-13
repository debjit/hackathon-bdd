<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Donation;
use App\Models\Requisition;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationCount extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Requisitons', Requisition::count())
                ->description('100% Requisiton increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Volunteers', User::count())
                ->description('100% Volunteer increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Donations', Donation::count())
                ->description('100% Donation increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
