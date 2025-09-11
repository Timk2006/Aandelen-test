<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        $aandelen = $user->aandelen()->get()->map(function ($aandeel) {
            $aandeel->totaal = $aandeel->prijs * $aandeel->pivot->aantal;
            return $aandeel;
        });

        $etfs = $user->etfs()->get()->map(function ($etf) {
            $etf->totaal = $etf->prijs * $etf->pivot->aantal;
            return $etf;
        });

        $totaalPortefeuille = $aandelen->sum('totaal') + $etfs->sum('totaal');

        return Inertia::render('portfolio', [
            'wallet_balance' => $wallet->balance,
            'aandelen' => $aandelen,
            'etfs' => $etfs,
            'totaal_portefeuille' => $totaalPortefeuille,
        ]);
    }
}
