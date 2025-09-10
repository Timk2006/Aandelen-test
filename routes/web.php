<?php

use App\Http\Controllers\AandeelTransactieController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AandelenController;
use App\Http\Controllers\AandelenKoopController;
use App\Http\Controllers\EtfKoopController;
use App\Http\Controllers\EtfController;
use App\Http\Controllers\WalletController;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');


Route::get('/etf', [EtfController::class, 'index'])->name('etf');

Route::get('/aandelen', [AandelenController::class, 'index'])->name('aandelen');

Route::match(['get', 'post'], '/wallet', [WalletController::class, 'handle'])->name('wallet');

Route::get('/kopen', [AandelenKoopController::class, 'index'])->name('kopen');

Route::get('/transacties', [AandeelTransactieController::class, 'index'])->name('transacties.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

});
