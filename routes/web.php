
<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AandelenController,AandelenKoopController, EtfKoopController, EtfController, WalletController, AandeelTransactieController,PortfolioController, EtfTransactieController, BotController, PrijsUpdateController, VerkoopController};

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

Route::match(['get', 'post'], '/prijzen/update', [PrijsUpdateController::class, 'update'])->name('update');

Route::get('/etf', [EtfController::class, 'index'])->name('etf');

Route::get('/aandelen', [AandelenController::class, 'index'])->name('aandelen');

// Admin: beheer aandelen (zichtbaar voor ingelogde gebruikers; server valideert admin)
Route::get('/admin/aandelen', function () {
    $user = Auth::user();
    if (! $user || ! ($user->is_admin ?? false)) {
        abort(403);
    }
    $aandelen = Aandeel::orderBy('naam')->get();
    return Inertia::render('Admin/Aandelen/Index', [
        'aandelen' => $aandelen,
    ]);
})->middleware('auth')->name('admin.aandelen');

Route::match(['get', 'post'], '/wallet', [WalletController::class, 'handle'])->name('wallet');


// Toon de verkoop-pagina
Route::get('/verkoop', function () {
    $user = Auth::user();
    $aandelen = $user->Aandelen()->withPivot('aantal')->get();
    return Inertia::render('AandelenVerkoop', [
        'aandelen' => $aandelen,
    ]);
})->middleware(['auth', 'verified'])->name('verkoop');

// Verwerk de verkoop
Route::post('/verkoop', [VerkoopController::class, 'verkoop']);

Route::match(['get', 'post'], '/kopen', [AandelenKoopController::class, 'handle'])->name('kopen');
Route::match(['get', 'post'], '/etf.buy', [EtfKoopController::class, 'handle'])->name('Etfkopen');

Route::post('/etf/buy', [EtfTransactieController::class, 'buy'])->name('etf.buy');

Route::post('/bot/vraag', [BotController::class, 'vraag']);

// Verkoop route: POST /verkoop, stuurt naar VerkoopController@verkoop
Route::get('/transacties', [AandeelTransactieController::class, 'index'])->name('transacties.index');

    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

    Route::middleware('auth')->group(function () {
    Route::post('/aandelen/add', fn(Request $r)=>Aandeel::create($r->only('naam','prijs')));
    Route::delete('/aandelen/{aandeel}', [AandelenController::class, 'destroy'])->name('aandelen.destroy');
});

Route::get('/aandelen-beheer', function () {
    $aandeel = \App\Models\Aandeel::all();
    return view('aandelen', compact('aandeel'));
})->middleware('auth');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

});
