<?php

namespace App\Filament\Resources\HospitalResource\Pages;

use App\Filament\Resources\HospitalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHospital extends ViewRecord
{
    protected static string $resource = HospitalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
