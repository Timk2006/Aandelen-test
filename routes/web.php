
<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AandelenController,AandelenKoopController, EtfKoopController, EtfController, WalletController, AandeelTransactieController,PortfolioController, EtfTransactieController, BotController};

use Inertia\Inertia;
use App\Models\{user, Wallet, Etf, Aandeel, TransactieModel};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/bot', function () {
    return Inertia::render('Bot');
})->name('bot');

Route::get('/bot/vraag', function () {
    return session('bot_debug') ?? ['info' => 'Nog geen vraag ontvangen.'];
});

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


Route::match(['get', 'post'], '/kopen', [AandelenKoopController::class, 'handle'])->name('kopen');
Route::match(['get', 'post'], '/etf.buy', [EtfKoopController::class, 'handle'])->name('Etfkopen');

Route::post('/etf/buy', [EtfTransactieController::class, 'buy'])->name('etf.buy');

Route::post('/bot/vraag', [BotController::class, 'vraag']);


Route::get('/transacties', [AandeelTransactieController::class, 'index'])->name('transacties.index');

    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

});
