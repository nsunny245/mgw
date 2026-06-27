<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelBookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'hotelBookings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('supplier_id')
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Hotel Supplier'),
                Forms\Components\TextInput::make('hotel_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('check_in'),
                Forms\Components\DatePicker::make('check_out'),
                Forms\Components\TextInput::make('number_rooms')
                    ->numeric()
                    ->default(1),
                Forms\Components\Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                    ])
                    ->default('Confirmed')
                    ->required(),
                Forms\Components\FileUpload::make('voucher_file_path')
                    ->disk('public')
                    ->directory('customer-vouchers')
                    ->label('Upload Hotel Voucher'),
                Forms\Components\Textarea::make('guests')
                    ->placeholder('Enter guest names per room...')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('hotel_name')
            ->columns([
                Tables\Columns\TextColumn::make('hotel_name')->sortable(),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('check_in')->date()->sortable(),
                Tables\Columns\TextColumn::make('check_out')->date(),
                Tables\Columns\TextColumn::make('number_rooms')->label('Rooms'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Confirmed' => 'success',
                        'Pending' => 'warning',
                        default => 'secondary',
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download_voucher')
                    ->url(fn ($record) => asset('storage/' . $record->voucher_file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => !empty($record->voucher_file_path)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
