<?php

namespace App\Filament\Resources\PackageResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalendarsRelationManager extends RelationManager
{
    protected static string $relationship = 'calendars';

    public function form(Form $form): Form
    {
        $months = [
            'January' => 'January', 'February' => 'February', 'March' => 'March',
            'April' => 'April', 'May' => 'May', 'June' => 'June',
            'July' => 'July', 'August' => 'August', 'September' => 'September',
            'October' => 'October', 'November' => 'November', 'December' => 'December'
        ];

        return $form
            ->schema([
                Forms\Components\Select::make('month')
                    ->options($months)
                    ->required(),
                Forms\Components\TextInput::make('year')
                    ->numeric()
                    ->default(intval(date('Y')))
                    ->required(),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->prefix('£'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Available' => 'Available',
                        'Filling Fast' => 'Filling Fast',
                        'Sold Out' => 'Sold Out',
                    ])
                    ->default('Available')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('month')
            ->columns([
                Tables\Columns\TextColumn::make('month')
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn ($state) => '£' . number_format($state, 2))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Available' => 'success',
                        'Filling Fast' => 'warning',
                        'Sold Out' => 'danger',
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
