<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/', [PropertyController::class, 'index']);
Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/properties/{id}/quote', [PropertyController::class, 'getQuote'])->name('properties.quote');
Route::get('/checkout', [PropertyController::class, 'checkout'])->name('checkout');

// Test url
Route::get('/test', function () {
    return view('test');
});