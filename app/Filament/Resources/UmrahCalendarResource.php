<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmrahCalendarResource\Pages;
use App\Filament\Resources\UmrahCalendarResource\RelationManagers;
use App\Models\UmrahCalendar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UmrahCalendarResource extends Resource
{
    protected static ?string $model = UmrahCalendar::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Packages Management';
    protected static ?string $navigationLabel = 'Umrah Calendar Planner';
    protected static ?string $modelLabel = 'Calendar Planner Entry';
    protected static ?string $pluralModelLabel = 'Umrah Calendar Planner';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Manager', 'Sales Agent', 'Operations Officer']) ?? false;
    }

    public static function form(Form $form): Form
    {
        $months = [
            'January' => 'January', 'February' => 'February', 'March' => 'March',
            'April' => 'April', 'May' => 'May', 'June' => 'June',
            'July' => 'July', 'August' => 'August', 'September' => 'September',
            'October' => 'October', 'November' => 'November', 'December' => 'December'
        ];

        return $form
            ->schema([
                Forms\Components\Select::make('package_id')
                    ->relationship('package', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.title')
                    ->searchable()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('month')
                    ->options([
                        'January' => 'January', 'February' => 'February', 'March' => 'March',
                        'April' => 'April', 'May' => 'May', 'June' => 'June',
                        'July' => 'July', 'August' => 'August', 'September' => 'September',
                        'October' => 'October', 'November' => 'November', 'December' => 'December'
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUmrahCalendars::route('/'),
        ];
    }
}
