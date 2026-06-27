<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'CRM & Customer Operations';

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['Super Admin', 'Manager', 'Sales Agent', 'Visa Officer', 'Finance Officer', 'Operations Officer']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('Personal Information')
                            ->schema([
                                Forms\Components\TextInput::make('full_name')->required()->maxLength(255),
                                Forms\Components\TextInput::make('email')->email()->maxLength(255),
                                Forms\Components\TextInput::make('mobile')->maxLength(255),
                                Forms\Components\TextInput::make('passport_number')->maxLength(255),
                                Forms\Components\TextInput::make('nationality')->maxLength(255),
                                Forms\Components\DatePicker::make('date_birth')->label('Date of Birth'),
                                Forms\Components\Textarea::make('address')->columnSpanFull(),
                            ])->columnSpan(2)->columns(2),
                        
                        Forms\Components\Section::make('System & Status')
                            ->schema([
                                Forms\Components\Select::make('status')
                                    ->options([
                                        'Lead' => 'New Lead',
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
                                    ])->default('Lead')->required(),
                                Forms\Components\Select::make('agent_id')
                                    ->relationship('agent', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->label('Assigned Agent'),
                                Forms\Components\TextInput::make('lead_source')->default('Organic')->maxLength(255),
                            ])->columnSpan(1),

                        Forms\Components\Section::make('Travel Information')
                            ->schema([
                                Forms\Components\Select::make('package_id')
                                    ->relationship('package', 'title')
                                    ->searchable()
                                    ->preload()
                                    ->label('Package Selected'),
                                Forms\Components\TextInput::make('departure_city')->maxLength(255),
                                Forms\Components\DatePicker::make('travel_date'),
                                Forms\Components\DatePicker::make('return_date'),
                            ])->columnSpan(2)->columns(2),

                        Forms\Components\Section::make('Financial Accounts')
                            ->schema([
                                Forms\Components\TextInput::make('package_value')
                                    ->numeric()
                                    ->prefix('£')
                                    ->default(0.00),
                                Forms\Components\TextInput::make('deposit_amount')
                                    ->numeric()
                                    ->prefix('£')
                                    ->default(0.00),
                                Forms\Components\TextInput::make('remaining_balance')
                                    ->numeric()
                                    ->prefix('£')
                                    ->disabled()
                                    ->dehydrated(),
                                Forms\Components\Textarea::make('notes')->columnSpanFull(),
                            ])->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('mobile'),
                Tables\Columns\TextColumn::make('package.title')->label('Package'),
                Tables\Columns\TextColumn::make('travel_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('remaining_balance')
                    ->formatStateUsing(fn ($state) => '£' . number_format($state, 2))
                    ->color(fn ($state) => floatval($state) > 0 ? 'danger' : 'success')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Lead' => 'secondary',
                        'Visa Processing', 'Booking In Progress' => 'warning',
                        'Payment Completed', 'Travel Completed' => 'success',
                        'Payment Pending' => 'danger',
                        default => 'primary',
                    }),
                Tables\Columns\TextColumn::make('agent.name')->label('Agent'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Lead' => 'New Lead',
                        'Contacted' => 'Contacted',
                        'Visa Processing' => 'Visa Processing',
                        'Booking In Progress' => 'Booking In Progress',
                        'Payment Completed' => 'Payment Completed',
                        'Travel Completed' => 'Travel Completed',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('invoice')
                    ->label('Invoice/Itinerary')
                    ->icon('heroicon-o-printer')
                    ->url(fn ($record) => route('customer.invoice', $record->id))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('atol')
                    ->label('ATOL Certificate')
                    ->icon('heroicon-o-shield-check')
                    ->url(fn ($record) => route('customer.atol', $record->id))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DocumentsRelationManager::class,
            RelationManagers\VisaCasesRelationManager::class,
            RelationManagers\FlightBookingsRelationManager::class,
            RelationManagers\HotelBookingsRelationManager::class,
            RelationManagers\PaymentsRelationManager::class,
            RelationManagers\TasksRelationManager::class,
            RelationManagers\DigitalSignaturesRelationManager::class,
            RelationManagers\AtolCompliancesRelationManager::class,
            RelationManagers\TimelineEventsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
