<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CityController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\InquiryController;
use App\Http\Controllers\Frontend\PackageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/package/{slug}', [PackageController::class, 'show'])->name('package.show');
Route::get('/umrah-packages-{slug}', [CityController::class, 'show'])->name('city.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/inquiry-store', [InquiryController::class, 'store'])->name('inquiry.store');
