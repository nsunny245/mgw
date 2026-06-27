<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InquiryResource\Pages;
use App\Models\Inquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Leads';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Manager', 'Sales Agent', 'Finance Officer', 'Visa Officer', 'Support Staff']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Lead Information')
                ->schema([
                    Forms\Components\TextInput::make('name')->disabled(),
                    Forms\Components\TextInput::make('phone')->disabled(),
                    Forms\Components\TextInput::make('email')->disabled(),
                    Forms\Components\TextInput::make('city')->disabled(),
                    Forms\Components\TextInput::make('persons')->disabled(),
                    Forms\Components\DatePicker::make('travel_date')->disabled(),
                    Forms\Components\TextInput::make('package_type')->disabled(),
                    Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
                ])->columns(2),
            Forms\Components\Section::make('CRM Workflow & Assignment')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'New Inquiry' => 'New Inquiry',
                            'Contacted' => 'Contacted',
                            'Consultation Scheduled' => 'Consultation Scheduled',
                            'Interested' => 'Interested',
                            'Documents Requested' => 'Documents Requested',
                            'Documents Received' => 'Documents Received',
                            'Visa Processing' => 'Visa Processing',
                            'Booking In Progress' => 'Booking In Progress',
                            'Payment Pending' => 'Payment Pending',
                            'Payment Completed' => 'Payment Completed',
                            'Travel Completed' => 'Travel Completed',
                            'Archived' => 'Archived',
                        ])->required()->default('New Inquiry'),
                    Forms\Components\Select::make('assigned_to')
                        ->relationship('assignedTo', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Assigned Staff'),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'New Inquiry' => 'danger',
                        'Contacted' => 'warning',
                        'Booking In Progress' => 'primary',
                        'Payment Completed' => 'success',
                        default => 'secondary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('travel_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('package_type'),
                Tables\Columns\TextColumn::make('assignedTo.name')->label('Staff'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'New Inquiry' => 'New Inquiry',
                        'Contacted' => 'Contacted',
                        'Booking In Progress' => 'Booking In Progress',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('convert_to_customer')
                    ->label('Convert to Customer')
                    ->icon('heroicon-o-user-plus')
                    ->color('success')
                    ->action(function (Inquiry $record) {
                        $customer = \App\Models\Customer::create([
                            'inquiry_id' => $record->id,
                            'full_name' => $record->name,
                            'email' => $record->email,
                            'mobile' => $record->phone,
                            'departure_city' => $record->city,
                            'travel_date' => $record->travel_date,
                            'status' => 'Lead',
                            'agent_id' => $record->assigned_to,
                        ]);

                        $customer->timelineEvents()->create([
                            'user_id' => auth()->id(),
                            'event_type' => 'Inquiry Converted',
                            'description' => 'Lead converted automatically from Inquiry #' . $record->id,
                        ]);

                        $record->update(['status' => 'Booking In Progress']);

                        \Filament\Notifications\Notification::make()
                            ->title('Inquiry Converted Successfully')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInquiries::route('/'),
            'view' => Pages\ViewInquiry::route('/{record}'),
        ];
    }
}
