<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

require __DIR__.'/auth.php';

Route::controller(QuoteController::class) -> middleware('auth') -> group(function() {
    Route::get('/', 'index')->name('dashboard');
});
