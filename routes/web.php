<?php

use App\Http\Controllers\AandelenControler;
use App\Http\Controllers\AandelenKoopControler;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AandelenController;
use App\Http\Controllers\AandelenKoopController;
use App\Http\Controllers\EtfController;
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

Route::get('/Contact', function () {
    return Inertia::render('Contact');
})->name('Contact');


;

Route::get('/etf', [EtfController::class, 'index'])->name('etf');


Route::get('/Aandelen', [AandelenController::class, 'index'])->name('aandelen');

Route::get('/Kopen', [AandelenKoopController::class, 'index'])->name('Kopen');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

});

Route::get('/wallet', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    if (!$user->wallet) {
        $user->wallet()->create(['balance' => 1000.00]);
    }

    return view('wallet', ['balance' => $user->wallet->balance]);
});

Route::post('/wallet', function (Request $request) {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login');
    }

    if (!$user->wallet) {
        $user->wallet()->create(['balance' => 1000.00]);
    }

    $user->wallet->increment('balance', $request->amount);

return redirect('/wallet');
});