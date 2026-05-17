<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Packages Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Package Details')
                ->schema([
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    SpatieMediaLibraryFileUpload::make('thumbnail')->collection('packages')->image()->imageEditor(),
                    Forms\Components\Select::make('category_id')->relationship('category', 'name')->searchable(),
                    Forms\Components\Textarea::make('short_description'),
                    Forms\Components\RichEditor::make('description')->columnSpanFull(),
                    Forms\Components\TextInput::make('price')->numeric(),
                    Forms\Components\TextInput::make('duration'),
                    Forms\Components\Select::make('star_rating')->options([
                        '3 Star' => '3 Star',
                        '4 Star' => '4 Star',
                        '5 Star' => '5 Star',
                    ]),
                    Forms\Components\TextInput::make('departure_city'),
                    Forms\Components\Toggle::make('featured'),
                ])->columns(2),
            Forms\Components\Section::make('SEO')
                ->schema([
                    Forms\Components\TextInput::make('meta_title'),
                    Forms\Components\Textarea::make('meta_description'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\IconColumn::make('featured')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
