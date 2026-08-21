<?php

namespace App\Helpers;

use Filament\Forms;

class SeoFormHelper
{
    /**
     * Get the reusable Filament forms SEO schema section.
     */
    public static function getSeoFormSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make('SEO & Metadata Management')
            ->description('Manage search engine optimization (SEO), OpenGraph tags, canonical rules, and keyword targets.')
            ->collapsible()
            ->collapsed()
            ->relationship('seo')
            ->schema([
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(65)
                            ->live(onBlur: true)
                            ->hint(fn ($state) => strlen($state ?? '') . ' / 65 chars')
                            ->helperText('Ideal length: 30 to 65 characters.'),
                        
                        Forms\Components\TextInput::make('primary_keyword')
                            ->placeholder('e.g. Umrah Packages')
                            ->helperText('Main focus keyword for content optimization.'),
                    ]),

                Forms\Components\Textarea::make('meta_description')
                    ->maxLength(160)
                    ->live(onBlur: true)
                    ->hint(fn ($state) => strlen($state ?? '') . ' / 160 chars')
                    ->helperText('Ideal length: 100 to 160 characters.')
                    ->rows(2)
                    ->columnSpanFull(),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('canonical_url_override')
                            ->url()
                            ->placeholder('https://www.makkahgateway.co.uk/package/example')
                            ->helperText('Only use if pointing off-domain or to a preferred canonical variant.'),
                        
                        Forms\Components\TagsInput::make('secondary_keywords')
                            ->placeholder('New keyword')
                            ->helperText('Additional keywords targeting search intents.'),
                    ]),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Toggle::make('robots_index')
                            ->label('Index (allow search engines to list this page)')
                            ->default(true),
                        
                        Forms\Components\Toggle::make('robots_follow')
                            ->label('Follow (allow search engines to follow links)')
                            ->default(true),
                    ]),

                Forms\Components\Fieldset::make('Open Graph (Social Sharing)')
                    ->schema([
                        Forms\Components\TextInput::make('og_title')
                            ->placeholder('Facebook / Sharing Title'),
                        Forms\Components\TextInput::make('og_image')
                            ->url()
                            ->placeholder('https://example.com/image.jpg')
                            ->helperText('Fully-qualified URL to open graph sharing card image.'),
                        Forms\Components\Textarea::make('og_description')
                            ->rows(2)
                            ->columnSpanFull()
                            ->placeholder('Facebook / Sharing Description'),
                    ]),

                Forms\Components\Textarea::make('schema_overrides')
                    ->rows(2)
                    ->placeholder('{"@context": "https://schema.org", ...}')
                    ->helperText('Custom JSON-LD schema overrides to render in head.')
                    ->columnSpanFull(),
            ]);
    }
}
