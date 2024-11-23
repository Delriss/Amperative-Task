<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

require __DIR__.'/auth.php';
require __DIR__.'/api.php';

Route::controller(QuoteController::class) -> middleware('auth') -> group(function() {
    Route::get('/', 'index')->name('dashboard');
});
