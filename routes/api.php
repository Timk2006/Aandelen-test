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
            ['name' => 'Contact', 'url' => '/contact'],
            ['name' => 'Portfolio', 'url' => '/portfolio'],
        ])->filter(fn($p) => str_contains(strtolower($p['name']), strtolower($q)))->values(),
    ];
});


