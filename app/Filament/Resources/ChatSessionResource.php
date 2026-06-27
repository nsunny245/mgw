<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatSessionResource\Pages;
use App\Filament\Resources\ChatSessionResource\RelationManagers;
use App\Models\ChatSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChatSessionResource extends Resource
{
    protected static ?string $model = ChatSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'CRM & Customer Operations';
    protected static ?string $navigationLabel = 'Live Support Chats';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Manager', 'Support Staff']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Visitor details')
                    ->schema([
                        Forms\Components\TextInput::make('visitor_name')
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\TextInput::make('visitor_email')
                            ->disabled()
                            ->dehydrated(),
                    ])->columns(2),

                Forms\Components\Section::make('Chat Control')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'open' => 'Active / Open',
                                'closed' => 'Resolved / Closed',
                            ])
                            ->required(),
                        Forms\Components\Select::make('assigned_to')
                            ->relationship('assignedTo', 'name')
                            ->label('Assigned Support agent')
                            ->preload()
                            ->searchable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visitor_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visitor_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'closed' => 'secondary',
                        default => 'primary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('assignedTo.name')
                    ->label('Assigned Staff')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Started At')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'open' => 'Active / Open',
                        'closed' => 'Resolved / Closed',
                    ]),
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
            RelationManagers\MessagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatSessions::route('/'),
            'create' => Pages\CreateChatSession::route('/create'),
            'edit' => Pages\EditChatSession::route('/{record}/edit'),
        ];
    }
}
