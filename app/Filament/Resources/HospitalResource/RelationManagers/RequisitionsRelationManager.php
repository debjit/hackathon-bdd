<?php

namespace App\Filament\Resources\HospitalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequisitionsRelationManager extends RelationManager
{
    protected static string $relationship = 'requisitions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('patient_name')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('patient_name')
            ->columns([
                Tables\Columns\TextColumn::make('patient_name')
                    ->description(fn (\App\Models\Requisition $record) => $record->primary_contact)
                    // ->description(fn (\App\Models\Requisition $record) => $record->secondary_contact)
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')->date(),
                Tables\Columns\TextColumn::make('unit'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
