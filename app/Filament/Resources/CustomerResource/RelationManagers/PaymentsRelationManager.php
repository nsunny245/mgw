<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->prefix('£')
                    ->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->default(date('Y-m-d'))
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'Card' => 'Card Payment',
                        'Bank Transfer' => 'Bank Transfer',
                        'Cash' => 'Cash',
                        'Cheque' => 'Cheque',
                    ])
                    ->default('Bank Transfer')
                    ->required(),
                Forms\Components\FileUpload::make('receipt_file_path')
                    ->disk('public')
                    ->directory('customer-receipts')
                    ->label('Upload Receipt Document'),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('amount')
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->formatStateUsing(fn ($state) => '£' . number_format($state, 2))
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('notes')->limit(30),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download_receipt')
                    ->url(fn ($record) => asset('storage/' . $record->receipt_file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => !empty($record->receipt_file_path)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
