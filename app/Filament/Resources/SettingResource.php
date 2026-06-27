<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Settings Management';

    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('General Settings')
                ->schema([
                    Forms\Components\TextInput::make('site_name')->required(),
                    Forms\Components\TextInput::make('phone'),
                    Forms\Components\TextInput::make('email')->label('Notification/Inquiry Recipient Email')->email()->required(),
                    Forms\Components\TextInput::make('address'),
                ]),
            Forms\Components\Section::make('Social Media Links')
                ->schema([
                    Forms\Components\TextInput::make('facebook_url')->url()->label('Facebook Page URL'),
                    Forms\Components\TextInput::make('instagram_url')->url()->label('Instagram URL'),
                    Forms\Components\TextInput::make('youtube_url')->url()->label('YouTube URL'),
                    Forms\Components\TextInput::make('linkedin_url')->url()->label('LinkedIn URL'),
                    Forms\Components\TextInput::make('twitter_url')->url()->label('Twitter / X URL'),
                    Forms\Components\TextInput::make('whatsapp_number')->label('WhatsApp Contact Number (digits only, e.g. 447380888233)'),
                ])->columns(2),
            Forms\Components\Section::make('SEO Connectors & Google Tools')
                ->description('Connect Google Analytics, Google Search Console, Google Tag Manager and custom tracking scripts.')
                ->schema([
                    Forms\Components\TextInput::make('google_analytics_id')
                        ->label('Google Analytics (GA4) Measurement ID')
                        ->placeholder('e.g. G-XXXXXXXXXX'),
                    Forms\Components\TextInput::make('google_tag_manager_id')
                        ->label('Google Tag Manager (GTM) Container ID')
                        ->placeholder('e.g. GTM-XXXXXXX'),
                    Forms\Components\Textarea::make('google_search_console_meta')
                        ->label('Google Search Console Meta Verification Tag / Code')
                        ->placeholder('e.g. <meta name="google-site-verification" content="..." />')
                        ->rows(2),
                    Forms\Components\Textarea::make('custom_head_scripts')
                        ->label('Custom Head Scripts (Injected before </head>)')
                        ->placeholder('<script>...</script>')
                        ->rows(3),
                    Forms\Components\Textarea::make('custom_body_scripts')
                        ->label('Custom Body Scripts (Injected right after <body>)')
                        ->placeholder('<script>...</script>')
                        ->rows(3),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email')->label('Notification Email'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
