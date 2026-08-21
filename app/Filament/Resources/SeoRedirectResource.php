<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeoRedirectResource\Pages;
use App\Models\SeoRedirect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeoRedirectResource extends Resource
{
    protected static ?string $model = SeoRedirect::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationGroup = 'Settings Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Redirect Definition')
                ->schema([
                    Forms\Components\TextInput::make('source_path')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->placeholder('/legacy-page-path'),
                    Forms\Components\TextInput::make('destination_url')
                        ->required()
                        ->placeholder('/new-page-path or full URL'),
                    Forms\Components\Select::make('status_code')
                        ->options([
                            301 => '301 Permanent',
                            302 => '302 Temporary',
                        ])
                        ->default(301)
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->required(),
                    Forms\Components\Textarea::make('notes')
                        ->rows(2)
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('source_path')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('destination_url')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('status_code')
                    ->badge()
                    ->color(fn (int $state) => $state === 301 ? 'success' : 'warning'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('hit_count')->sortable(),
                Tables\Columns\TextColumn::make('last_hit_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSeoRedirects::route('/'),
        ];
    }
}
