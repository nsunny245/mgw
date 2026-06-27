<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Travel ERP Financials';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Manager', 'Finance Officer', 'Operations Officer']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'Hotel' => 'Hotel Supplier',
                        'Airline' => 'Airline Partner',
                        'Transport' => 'Transport Provider',
                        'Visa Partner' => 'Visa Partner Agency',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('contract_file')
                    ->disk('public')
                    ->directory('supplier-contracts')
                    ->label('Upload Supplier Agreement Contract'),
                Forms\Components\Textarea::make('contact_details')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('type')->badge()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'Hotel' => 'Hotel Supplier',
                        'Airline' => 'Airline Partner',
                        'Transport' => 'Transport Provider',
                        'Visa Partner' => 'Visa Partner Agency',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('download_contract')
                    ->url(fn ($record) => asset('storage/' . $record->contract_file))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => !empty($record->contract_file)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSuppliers::route('/'),
        ];
    }
}
