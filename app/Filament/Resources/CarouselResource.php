<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarouselResource\Pages;
use App\Models\Carousel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CarouselResource extends Resource
{
    protected static ?string $model = Carousel::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationGroup = 'Site Management';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Manager']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Carousel Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. Airline Partners'),
                        Forms\Components\Select::make('location')
                            ->options([
                                'home_under_hero' => 'Home Page - Below Hero (Airline Logos)',
                            ])
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Select where on the website this carousel will be displayed.'),
                        Forms\Components\Toggle::make('active')
                            ->default(true)
                            ->label('Active / Visible'),
                    ])->columns(2),

                Forms\Components\Section::make('Slides / Items')
                    ->schema([
                        Forms\Components\Repeater::make('slides')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('carousels')
                                    ->required()
                                    ->label('Logo / Image'),
                                Forms\Components\TextInput::make('title')
                                    ->label('Alt / Title text')
                                    ->placeholder('e.g. Saudi Arabian Airlines'),
                                Forms\Components\TextInput::make('link')
                                    ->url()
                                    ->label('Target Link (URL)')
                                    ->placeholder('e.g. https://www.saudia.com'),
                            ])
                            ->columns(3)
                            ->defaultItems(1)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Slide')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('slides')
                    ->label('Total Slides')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) . ' Slide(s)' : '0 Slides'),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Disabled to prevent PHP intl extension crash
            ]);
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
            'index' => Pages\ListCarousels::route('/'),
            'create' => Pages\CreateCarousel::route('/create'),
            'edit' => Pages\EditCarousel::route('/{record}/edit'),
        ];
    }
}
