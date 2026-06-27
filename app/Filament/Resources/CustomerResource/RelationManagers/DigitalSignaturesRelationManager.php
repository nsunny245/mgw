<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DigitalSignaturesRelationManager extends RelationManager
{
    protected static string $relationship = 'digitalSignatures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('document_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Sent' => 'Sent',
                        'Viewed' => 'Viewed',
                        'Signed' => 'Signed',
                        'Expired' => 'Expired',
                    ])
                    ->default('Draft')
                    ->required(),
                Forms\Components\FileUpload::make('file_path')
                    ->disk('public')
                    ->directory('customer-agreements')
                    ->label('Upload Agreement/Contract Document'),
                Forms\Components\DateTimePicker::make('sent_at'),
                Forms\Components\DateTimePicker::make('viewed_at'),
                Forms\Components\DateTimePicker::make('signed_at'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('document_name')
            ->columns([
                Tables\Columns\TextColumn::make('document_name')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Signed' => 'success',
                        'Sent', 'Viewed' => 'warning',
                        'Expired' => 'danger',
                        'Draft' => 'secondary',
                        default => 'secondary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('sent_at')->dateTime(),
                Tables\Columns\TextColumn::make('signed_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download_document')
                    ->url(fn ($record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => !empty($record->file_path)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
