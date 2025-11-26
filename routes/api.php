<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Aandeel;
use App\Models\Etf;

use App\Http\Controllers\BotController;

Route::get('/search', function () {
    $q = request('q');

    if (!$q) return [];


Route::post('api/bot/vraag', [BotController::class, 'vraag']);

  return [
        'aandelen' => Aandeel::where('naam', 'like', "%$q%")->limit(5)->get(),
        'etfs' => Etf::where('naam', 'like', "%$q%")->limit(5)->get(),
        'pages' => collect([
            ['name' => 'Home', 'url' => '/'],
            ['name' => 'Aandelen', 'url' => '/aandelen'],
            ['name' => 'ETF', 'url' => '/etf'],
            ['name' => 'Wallet', 'url' => '/wallet'],
            ['name' => 'Portfolio', 'url' => '/portfolio'],
             ['name' => 'Verkopen', 'url' => '/verkoop'],
              ['name' => 'Vragen chatbot', 'url' => '/bot'],
               ['name' => 'Kopen Aandelen', 'url' => '/kopen'],
                ['name' => 'Kopen Etf', 'url' => '/etf.buy'],
        ])->filter(fn($p) => str_contains(strtolower($p['name']), strtolower($q)))->values(),
    ];
});


