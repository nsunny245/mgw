<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisaCasesRelationManager extends RelationManager
{
    protected static string $relationship = 'visaCases';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('visa_type')
                    ->options([
                        'Umrah Visa' => 'Umrah Visa',
                        'Hajj Visa' => 'Hajj Visa',
                        'UK Visit Visa' => 'UK Visit Visa',
                        'Schengen Visa' => 'Schengen Visa',
                        'Tourist Visa' => 'Tourist Visa',
                        'Business Visa' => 'Business Visa',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('application_number'),
                Forms\Components\DatePicker::make('submission_date'),
                Forms\Components\DatePicker::make('appointment_date'),
                Forms\Components\TextInput::make('embassy'),
                Forms\Components\Select::make('officer_id')
                    ->relationship('officer', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Assigned Officer'),
                Forms\Components\Select::make('status')
                    ->options([
                        'Documents Pending' => 'Documents Pending',
                        'Ready For Submission' => 'Ready For Submission',
                        'Submitted' => 'Submitted',
                        'Under Review' => 'Under Review',
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                    ])
                    ->default('Documents Pending')
                    ->required(),
                Forms\Components\Textarea::make('notes')->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('visa_type')
            ->columns([
                Tables\Columns\TextColumn::make('visa_type')->sortable(),
                Tables\Columns\TextColumn::make('application_number')->searchable(),
                Tables\Columns\TextColumn::make('embassy'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Approved' => 'success',
                        'Documents Pending' => 'secondary',
                        'Ready For Submission', 'Submitted', 'Under Review' => 'warning',
                        'Rejected' => 'danger',
                        default => 'primary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('officer.name')->label('Officer'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
