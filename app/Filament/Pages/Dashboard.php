<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use App\Models\User;
use App\Models\Package;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('startDate')
                    ->label('Start Date'),
                DatePicker::make('endDate')
                    ->label('End Date'),
                Select::make('agent_id')
                    ->label('Agent')
                    ->options(User::pluck('name', 'id'))
                    ->placeholder('All Agents')
                    ->searchable(),
                Select::make('package_id')
                    ->label('Package')
                    ->options(Package::pluck('title', 'id'))
                    ->placeholder('All Packages')
                    ->searchable(),
            ]);
    }
}
