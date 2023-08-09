<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequisitionResource\Pages;
use App\Filament\Resources\RequisitionResource\RelationManagers;
use App\Models\Requisition;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequisitionResource extends Resource
{
    protected static ?string $model = Requisition::class;
    protected static ?string $label = "Blood Requisition";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Patient Information')
                    ->icon('heroicon-o-users')
                    ->description('Please share patient contact information wtih us.')
                    // ->aside()
                    ->schema([
                        TextInput::make('patient_name')
                            ->label('Patient Name')
                            ->required(),
                        Toggle::make('urgent')
                            ->label('Urgent ?')
                            ->required(),
                        TextInput::make('email')->required(),

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
                        Forms\Components\Select::make('hospital_id')
                            ->relationship('hospital', 'name')
                            ->searchable()
                            ->required(),
                    ])
                    ->collapsible()
                    ->columns(2),

                Section::make('Blood Requisition Details')
                    ->icon('heroicon-o-document-check')
                    ->description('Please share patient information wtih us.')
                    // ->isAside()
                    ->schema([
                        TextInput::make('unit')
                            ->numeric()
                            ->required()
                            ->maxLength(2),
                        Select::make('donation_type')->options([
                            1 => 'Whole Blood'
                        ])->required(),
                        Select::make('blood_group')->options([
                            1 => 'A+',
                            2 => 'B+',
                            3 => 'AB+',
                            4 => 'O+',
                            5 => 'A-',
                            6 => 'B-',
                            7 => 'AB-',
                            8 => 'O-'
                        ])->required(true),
                        DatePicker::make('required_on')->required(),
                    ])
                    ->collapsed()
                    ->columns(4),

                Section::make('Image, notes and status change')
                    ->icon('heroicon-o-cog')
                    ->description('Please share patient requisition image, notes with us.')
                    // ->isAside()
                    ->schema([
                        MarkdownEditor::make('notes'),
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor(),

                        Toggle::make('status')
                            ->label('Accept this requisition ?')
                            ->required(),
                    ])
                    ->collapsed(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient_name')->badge()
                    ->description(fn ($record) => $record->email)
                    ->searchable(isIndividual: true),
                TextColumn::make('required_on')
                    ->date()
                    ->searchable(isIndividual: true)
                    ->sortable(),
                IconColumn::make('urgent')
                    ->boolean()
                    ->sortable(),

                SelectColumn::make('blood_group')
                    ->disabled()
                    // ->searchable(isIndividual: true)
                    ->sortable()
                    ->options([
                        1 => 'A+',
                        2 => 'B+',
                        3 => 'AB+',
                        4 => 'O+',
                        5 => 'A-',
                        6 => 'B-',
                        7 => 'AB-',
                        8 => 'O-'
                    ]),
                TextColumn::make('unit')
                    ->badge()
                    ->description(fn ($record) => $record->type->name),
                TextColumn::make('primary_contact')
                    ->searchable(isIndividual: true)
                    ->description(fn ($record) => $record->secondary_contact),
                TextColumn::make('emergency_contact')
                    ->searchable(isIndividual: true),

            ])
            ->filters([
                SelectFilter::make('blood_group')
                    ->options([
                        1 => 'A+',
                        2 => 'B+',
                        3 => 'AB+',
                        4 => 'O+',
                        5 => 'A-',
                        6 => 'B-',
                        7 => 'AB-',
                        8 => 'O-'
                    ]),
                // Filter::make('urgent')

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->groups([
                'required_on',
                'required_blood_group.name',
            ])
            ->defaultGroup('required_on');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequisitions::route('/'),
            'create' => Pages\CreateRequisition::route('/create'),
            'view' => Pages\ViewRequisition::route('/{record}'),
            'edit' => Pages\EditRequisition::route('/{record}/edit'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['creator_id'] = auth()->id();

        return $data;
    }
}
