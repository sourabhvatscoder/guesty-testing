<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'home'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/properties/{id}/quote', [PropertyController::class, 'getQuote'])->name('properties.quote');
Route::post('/quotes/{quoteId}/upsells', [PropertyController::class, 'updateQuoteUpsells'])->name('quotes.upsells');
Route::get('/checkout', [PropertyController::class, 'checkout'])->name('checkout');
Route::get('/activities', [PropertyController::class, 'getActivities'])->name('activities');

// Test url
Route::get('/test', function () {
    return view('test');
});