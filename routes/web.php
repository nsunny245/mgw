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

Route::get('/ben-orbit-portal-7842/{path?}', function ($path = null) {
    return redirect('/admin' . ($path ? '/' . $path : ''));
})->where('path', '.*');

Route::get('/ben-orbit-portal/{path?}', function ($path = null) {
    return redirect('/admin' . ($path ? '/' . $path : ''));
})->where('path', '.*');

Route::get('/run-ga-setup', function () {
    $setting = \App\Models\Setting::first();
    if ($setting) {
        $setting->update(['google_analytics_id' => 'G-CJME2XSDZV']);
    }
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    return 'Google Analytics G-CJME2XSDZV successfully activated on live site!';
});
