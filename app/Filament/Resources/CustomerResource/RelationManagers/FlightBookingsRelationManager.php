<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightBookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'flightBookings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('airline')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('booking_reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('departure_date'),
                Forms\Components\DatePicker::make('return_date'),
                Forms\Components\TextInput::make('ticket_number'),
                Forms\Components\FileUpload::make('ticket_file_path')
                    ->disk('public')
                    ->directory('customer-tickets')
                    ->label('Upload E-Ticket'),
                Forms\Components\Textarea::make('passenger_details')
                    ->placeholder('Enter passenger names, seats, special requests...')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('booking_reference')
            ->columns([
                Tables\Columns\TextColumn::make('airline')->sortable(),
                Tables\Columns\TextColumn::make('booking_reference')->searchable(),
                Tables\Columns\TextColumn::make('departure_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('return_date')->date(),
                Tables\Columns\TextColumn::make('ticket_number'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download_ticket')
                    ->url(fn ($record) => asset('storage/' . $record->ticket_file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => !empty($record->ticket_file_path)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
