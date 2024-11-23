<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Test Route for Quotes
Route::get('/quotes/{number}', [QuoteController::class, 'getRandomQuotes'])->name('quotes.get');

require __DIR__.'/auth.php';
