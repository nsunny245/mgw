<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AtolCompliancesRelationManager extends RelationManager
{
    protected static string $relationship = 'atolCompliances';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('atol_certificate_number')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('protection_date'),
                Forms\Components\Toggle::make('terms_accepted')
                    ->label('Terms and Conditions Accepted')
                    ->default(false),
                Forms\Components\FileUpload::make('acknowledgement_file')
                    ->disk('public')
                    ->directory('atol-compliances')
                    ->label('Upload ATOL Protection Acknowledgement'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('atol_certificate_number')
            ->columns([
                Tables\Columns\TextColumn::make('atol_certificate_number')->searchable(),
                Tables\Columns\TextColumn::make('protection_date')->date()->sortable(),
                Tables\Columns\IconColumn::make('terms_accepted')->boolean()->label('Terms Accepted'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('download_cert')
                    ->url(fn ($record) => asset('storage/' . $record->acknowledgement_file))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-arrow-down-tray')
                    ->visible(fn ($record) => !empty($record->acknowledgement_file)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
