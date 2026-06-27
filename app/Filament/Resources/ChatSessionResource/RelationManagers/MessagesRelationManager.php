<?php

namespace App\Filament\Resources\ChatSessionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('message')
            ->defaultSort('created_at', 'asc')
            ->content(fn ($livewire) => view('filament.resources.chat.messages', [
                'records' => $livewire->getOwnerRecord()->messages()->with('user')->orderBy('created_at', 'asc')->get()
            ]))
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Send Reply')
                    ->icon('heroicon-o-paper-airplane')
                    ->form([
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->rows(3)
                            ->placeholder('Type your reply to the visitor here...'),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['sender'] = 'staff';
                        $data['user_id'] = auth()->id();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Disabled to prevent PHP intl extension crash
            ]);
    }
}
