<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\DonationsRelationManager;
use App\Filament\Resources\UserResource\RelationManagers\RequisitionsRelationManager;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Section::make('Name and Donation')
                    ->icon('heroicon-o-users')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    // ->aside()
                    ->schema([
                        TextInput::make('name')->columnSpan('full')->required(),
                        TextInput::make('password')->columnSpan('full')->required(),
                        Toggle::make('donor')
                            ->label('Is wiling Donate?')
                            ->required(),
                        Select::make('blood_group')
                        // ->relationship('bloodGroup','name')
                        // ->required(),
                            ->options([
                                1 => 'A+',
                                2 => 'B+',
                                3 => 'AB+',
                                4 => 'O+',
                                5 => 'A-',
                                6 => 'B-',
                                7 => 'AB-',
                                8 => 'O-',
                            ]),
                        DatePicker::make('last_donated'),
                    ])
                    ->columns(3),
                // ->compact(),
                // ->collapsible(),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('email')->columnSpan('full')->required(),
                        TextInput::make('primary_contact')
                            ->prefixIcon('heroicon-o-phone')
                            ->required()
                            ->tel()
                            ->length(10),
                        TextInput::make('secondary_contact')
                            ->prefixIcon('heroicon-o-phone')
                            ->tel()
                            ->length(10),
                        TextInput::make('emergency_contact')
                            ->prefixIcon('heroicon-o-phone')
                            ->tel()
                            ->length(10),
                    ])->columns(3),
                // ->addField(TextInput::make('name')),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\Layout\Stack::make([
                // ]),
                TextColumn::make('name')
                    ->searchable(isIndividual: true)
                    // ->html()
                    ->size(TextColumn\TextColumnSize::Large)
                    // ->suffix(fn (User $record) => $record->donations()->count() ? "({$record->donations()->count()})":"ooo")
                    ->description(fn (User $record) => $record->email),

                IconColumn::make('donor')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('last_donated')->searchable(isIndividual: true)->since()
                    ->description(fn (User $record) => $record->last_donated)
                    ->sortable(),
                TextColumn::make('primary_contact')
                    ->searchable(isIndividual: true)
                    ->description(fn (User $record) => $record->secondary_contact),
                TextColumn::make('emergency_contact')->searchable(),
                TextColumn::make('bloodGroup.name'),
                // ->disabled()
                // ->options([
                //     1 => 'A+',
                //     2 => 'B+',
                //     3 => 'AB+',
                //     4 => 'O+',
                //     5 => 'A-',
                //     6 => 'B-',
                //     7 => 'AB-',
                //     8 => 'O-'
                // ]),
            ])
            ->filters([
                Filter::make('donor')
                    ->query(fn (Builder $query) => $query->where('donor', true)),
                SelectFilter::make('blood_group')
                    ->options([
                        1 => 'A+',
                        2 => 'B+',
                        3 => 'AB+',
                        4 => 'O+',
                        5 => 'A-',
                        6 => 'B-',
                        7 => 'AB-',
                        8 => 'O-',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            DonationsRelationManager::class,
            RequisitionsRelationManager::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'primary_contact', 'secondary_contact', 'emergency_contact', 'last_donated'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
