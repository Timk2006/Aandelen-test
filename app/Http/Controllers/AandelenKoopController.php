<?php

namespace App\Http\Controllers;

use App\Models\Aandeel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AandelenKoopController extends Controller
{
    // Formulier tonen
    public function index()
    {
        $aandelen = Aandeel::all(); // alle aandelen ophalen
        return Inertia::render('Kopen', [
            'aandelen' => $aandelen
        ]);
    }

    // Aankoop verwerken
    public function koop(Request $request) 
    {
        $request->validate([
            'stock_id' => 'required|exists:aandelen,id',
            'aantal'   => 'required|integer|min:1',
        ]);

        $user  = auth()->user();
        $stock = Aandeel::find($request->stock_id);
        $totaalPrijs = $stock->prijs * $request->aantal;

        if ($user->saldo < $totaalPrijs) {
            return back()->withErrors(['saldo' => 'Onvoldoende saldo om deze aankoop te doen.']);
        }

        $user->saldo -= $totaalPrijs;
        $user->save();

        $user->aandelen()->attach($stock->id, ['aantal' => $request->aantal]);

        return back()->with('success', 'Aandelen succesvol gekocht!');
    }
}
