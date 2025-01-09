<?php

use App\Mail\CustomerServiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BoardingHouseController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/boarding-house/{slug}', [BoardingHouseController::class, 'show'])->name('show-boarding-house-by-slug');
Route::get('/boarding-house/{slug}/rooms', [BoardingHouseController::class, 'rooms'])->name('show-rooms-list-in-boarding-house-by-slug');
Route::get('/boarding-houses', [BoardingHouseController::class, 'boardingHouses'])->name('show-boarding-houses');

Route::get('/boarding-house/booking/{slug}', [BookingController::class, 'booking'])->name('show-booking');
Route::get('/boarding-house/booking/{slug}/info', [BookingController::class, 'information'])->name('show-booking-information');
Route::post('/boarding-house/booking/{slug}/save', [BookingController::class, 'save'])->name('save-booking-information');
Route::get('/boarding-house/booking/{slug}/checkout', [BookingController::class, 'checkout'])->name('booking-checkout');
Route::post('/boarding-house/booking/{slug}/payment', [BookingController::class, 'payment'])->name('payment-process');
Route::get('/transaction-success', [BookingController::class, 'transactionSuccess'])->name('transaction-success');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('show-boarding-house-by-category-slug');
Route::get('/city/{slug}', [CityController::class, 'show'])->name('show-boarding-house-by-city-slug');
Route::get('/find', [BoardingHouseController::class, 'find'])->name('find-boarding-house');
Route::get('/find-results', [BoardingHouseController::class, 'findResults'])->name('find-results-boarding-house');
Route::get('/check-booking', [BookingController::class, 'checkBooking'])->name('check-booking');
Route::post('/check-booking', [BookingController::class, 'showBookingDetails'])->name('show-booking-details');

Route::get('/customer-service', [HomeController::class, 'customerService'])->name('customer-service');
Route::post('/customer-service', [HomeController::class, 'customerServiceMailProcess'])->name('customer-service-mail');

Route::fallback(function () {
    return redirect()->route('home');
});