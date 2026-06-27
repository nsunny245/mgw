<?php

namespace App\Filament\Widgets;

use App\Models\Inquiry;
use App\Models\Package;
use App\Models\Customer;
use App\Models\VisaCase;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Carbon\Carbon;

class DashboardOverview extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Get filter inputs
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;
        $agentId = $this->filters['agent_id'] ?? null;
        $packageId = $this->filters['package_id'] ?? null;

        // Build base queries
        $inquiryQuery = Inquiry::query();
        $customerQuery = Customer::query();
        $visaQuery = VisaCase::query();
        $paymentQuery = Payment::query();

        // Apply Date Filters
        if ($startDate) {
            $inquiryQuery->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
            $customerQuery->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
            $visaQuery->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
            $paymentQuery->where('payment_date', '>=', Carbon::parse($startDate)->startOfDay());
        }

        if ($endDate) {
            $inquiryQuery->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
            $customerQuery->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
            $visaQuery->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
            $paymentQuery->where('payment_date', '<=', Carbon::parse($endDate)->endOfDay());
        }

        // Apply Agent Filters
        if ($agentId) {
            $inquiryQuery->where('assigned_to', $agentId);
            $customerQuery->where('agent_id', $agentId);
            $visaQuery->whereHas('customer', fn ($q) => $q->where('agent_id', $agentId));
            $paymentQuery->whereHas('customer', fn ($q) => $q->where('agent_id', $agentId));
        }

        // Apply Package Filters
        if ($packageId) {
            // inquiries don't have package_id directly, but we can filter by customer match or ignore
            $customerQuery->where('package_id', $packageId);
            $visaQuery->whereHas('customer', fn ($q) => $q->where('package_id', $packageId));
            $paymentQuery->whereHas('customer', fn ($q) => $q->where('package_id', $packageId));
        }

        // Calculate Stats
        $totalInquiries = (clone $inquiryQuery)->count();
        $recentInquiriesCount = (clone $inquiryQuery)->where('created_at', '>=', now()->subDays(7))->count();

        $convertedCustomers = (clone $customerQuery)->count();
        $activeBookings = (clone $customerQuery)->where('status', 'Active Booking')->count();
        $travelCompletions = (clone $customerQuery)->where('status', 'Travel Completed')->count();

        $activeVisas = (clone $visaQuery)->whereNotIn('status', ['Approved', 'Rejected'])->count();
        $approvedVisas = (clone $visaQuery)->where('status', 'Approved')->count();

        $todayRevenue = (clone $paymentQuery)->whereDate('payment_date', today())->sum('amount');
        $monthRevenue = (clone $paymentQuery)->whereMonth('payment_date', now()->month)->whereYear('payment_date', now()->year)->sum('amount');
        $annualRevenue = (clone $paymentQuery)->whereYear('payment_date', now()->year)->sum('amount');
        $outstandingBalances = (clone $customerQuery)->sum('remaining_balance');

        return [
            Stat::make('Total Inquiries / Leads', $totalInquiries)
                ->description($recentInquiriesCount . ' in last 7 days (filtered)')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Converted Customers', $convertedCustomers)
                ->description('Converted from CRM inquiries')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            Stat::make('Active / Approved Visas', $activeVisas . ' / ' . $approvedVisas)
                ->description('Visa cases in progress vs approved')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            Stat::make('Today / Monthly Revenue', '£' . number_format($todayRevenue, 0) . ' / £' . number_format($monthRevenue, 0))
                ->description('Annual: £' . number_format($annualRevenue, 0))
                ->descriptionIcon('heroicon-m-currency-pound')
                ->color('success'),
            Stat::make('Outstanding Balances', '£' . number_format($outstandingBalances, 2))
                ->description('Total remaining balance to be collected')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('danger'),
            Stat::make('Bookings / Travel Completed', $activeBookings . ' / ' . $travelCompletions)
                ->description('Active bookings vs travel completions')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('info'),
        ];
    }
}
