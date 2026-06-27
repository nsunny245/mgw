<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'Passport' => 'Passport',
                        'Photograph' => 'Photograph',
                        'Visa Forms' => 'Visa Forms',
                        'Bank Statements' => 'Bank Statements',
                        'Residence Permit' => 'Residence Permit',
                        'Supporting Documents' => 'Supporting Documents',
                        'Flight Documents' => 'Flight Documents',
                        'Hotel Documents' => 'Hotel Documents',
                        'Custom Documents' => 'Custom Documents',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('file_path')
                    ->required()
                    ->disk('public')
                    ->directory('customer-documents'),
                Forms\Components\DatePicker::make('expiry_date'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Uploaded' => 'Uploaded',
                        'Verified' => 'Verified',
                        'Expired' => 'Expired',
                    ])
                    ->default('Uploaded')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->date()
                    ->color(fn ($state) => $state && \Carbon\Carbon::parse($state)->isPast() ? 'danger' : 'primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Verified' => 'success',
                        'Uploaded' => 'primary',
                        'Expired' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')->limit(30),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->url(fn ($record) => asset('storage/' . $record->file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
