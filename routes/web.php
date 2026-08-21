<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CalendarController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CityController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\InquiryController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/package/{slug}', [PackageController::class, 'show'])->name('package.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/umrah-calendar/{month}', [CalendarController::class, 'showMonth'])->name('calendar.month');
Route::get('/umrah-packages-{slug}', [CityController::class, 'show'])->name('city.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/about-us', [PageController::class, 'show'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/inquiry-store', [InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/thank-you', function () {
    return view('frontend.pages.thankyou');
})->name('thankyou');
Route::get('/customer/{id}/invoice', [HomeController::class, 'invoice'])->name('customer.invoice');
Route::get('/customer/{id}/atol', [HomeController::class, 'atol'])->name('customer.atol');

Route::post('/api/chat/start', [\App\Http\Controllers\ChatApiController::class, 'start']);
Route::post('/api/chat/send', [\App\Http\Controllers\ChatApiController::class, 'send']);
Route::get('/api/chat/messages/{id}', [\App\Http\Controllers\ChatApiController::class, 'getMessages']);

Route::get('/terms-and-conditions', function () {
    return view('frontend.pages.terms');
})->name('terms');

Route::get('/disclaimer', function () {
    return view('frontend.pages.disclaimer');
})->name('disclaimer');

Route::get('/faq', function () {
    return view('frontend.pages.faq');
})->name('faq');

Route::get('/ben-orbit-portal-7842/{path?}', function ($path = null) {
    return redirect('/admin' . ($path ? '/' . $path : ''));
})->where('path', '.*');

Route::get('/ben-orbit-portal/{path?}', function ($path = null) {
    return redirect('/admin' . ($path ? '/' . $path : ''));
})->where('path', '.*');

Route::get('/run-ga-setup', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate --force');
        \Illuminate\Support\Facades\Artisan::call('generate:sitemap');

        $setting = \App\Models\Setting::first();
        if ($setting) {
            $setting->update([
                'google_analytics_id' => 'G-CJME2XSDZV',
                'google_tag_manager_id' => 'GTM-KDZDXW2L',
                'atol_number' => $setting->atol_number ?: '11941',
            ]);
        }
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');

        return '<div style="font-family:sans-serif;padding:30px;max-width:600px;margin:50px auto;border:1px solid #10b981;border-radius:12px;background:#f0fdf4;text-align:center;">
            <h2 style="color:#047857;margin-top:0;">✅ Setup & Migration Complete!</h2>
            <p style="color:#374151;">Database migrations applied, Sitemaps compiled, Google Analytics/GTM enabled, and all caches cleared successfully.</p>
            <a href="/" style="display:inline-block;margin-top:15px;padding:10px 20px;background:#059669;color:#fff;text-decoration:none;border-radius:6px;font-weight:bold;">Return to Website</a>
        </div>';
    } catch (\Exception $e) {
        return '<div style="font-family:sans-serif;padding:30px;max-width:600px;margin:50px auto;border:1px solid #ef4444;border-radius:12px;background:#fef2f2;">
            <h2 style="color:#b91c1c;margin-top:0;">❌ Setup Error</h2>
            <pre style="background:#fff;padding:15px;border-radius:6px;overflow-x:auto;color:#1f2937;">' . e($e->getMessage()) . '</pre>
        </div>';
    }
});

Route::get('/debug-notifications', function () {
    $notificationsCount = \DB::table('notifications')->count();
    $inquiriesCount = \App\Models\Inquiry::count();
    $usersCount = \App\Models\User::count();
    
    // Read the last 20 lines of laravel log
    $logFile = storage_path('logs/laravel.log');
    $logs = 'Log file not found.';
    if (file_exists($logFile)) {
        $file = file($logFile);
        $logs = implode("", array_slice($file, -20));
    }
    
    return response()->json([
        'notifications_count' => $notificationsCount,
        'inquiries_count' => $inquiriesCount,
        'users_count' => $usersCount,
        'recent_logs' => $logs
    ]);
});
