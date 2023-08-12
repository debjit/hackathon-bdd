<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

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
                // Forms\Components\TextInput::make('user')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('user')
            ->columns([
                Tables\Columns\TextColumn::make('patient_name'),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Todo
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Todo
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                // Todo
                // Tables\Actions\CreateAction::make(),
            ]);
    }
}
