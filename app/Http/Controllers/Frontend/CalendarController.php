<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UmrahCalendar;
use Artesaos\SEOTools\Facades\SEOTools;

class CalendarController extends Controller
{
    public function showMonth($month)
    {
        $monthName = ucfirst(strtolower($month));
        
        $validMonths = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        if (!in_array($monthName, $validMonths)) {
            abort(404);
        }

        SEOTools::setTitle($monthName . ' Umrah Packages');
        SEOTools::setDescription('Compare and find the best Umrah packages departing in ' . $monthName . '. Browse hotel ratings, prices, and direct departures.');
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage(asset('frontend/images/hero-bg.png'));
        SEOTools::twitter()->setSite('@makkahgateway');

        $dbSchedules = UmrahCalendar::with(['package.category'])
            ->where('month', $monthName)
            ->get();

        $overriddenPackageIds = $dbSchedules->pluck('package_id')->toArray();

        $yearRoundPackages = \App\Models\Package::with('category')
            ->where('available_all_year', true)
            ->where('status', '!=', 'Sold Out')
            ->get();

        $schedules = collect($dbSchedules);

        foreach ($yearRoundPackages as $package) {
            if (!in_array($package->id, $overriddenPackageIds)) {
                $virtual = new UmrahCalendar([
                    'package_id' => $package->id,
                    'month' => $monthName,
                    'year' => intval(date('Y')),
                    'price' => $package->price,
                    'status' => $package->status,
                    'notes' => 'Flexible departure dates throughout the month',
                ]);
                $virtual->setRelation('package', $package);
                $schedules->push($virtual);
            }
        }

        return view('frontend.calendar.month', compact('monthName', 'schedules'));
    }
}
