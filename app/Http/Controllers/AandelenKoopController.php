<?php

namespace App\Http\Controllers;

use App\Models\Aandeel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AandelenKoopController extends Controller
{
    public function handle(Request $request)
    {
        if ($request->isMethod('post')) {
            // POST → verwerk aankoop
            $request->validate([
                'aandeel_id' => 'required|exists:aandelen,id',
                'aantal'     => 'required|integer|min:1',
            ]);

            $user   = Auth::user();
            $wallet = $user->wallet;
            $aandeel = Aandeel::findOrFail($request->aandeel_id);
            $totaal = $aandeel->prijs * $request->aantal;

            if ($wallet->balance < $totaal) {
                return back()->withErrors(['saldo' => 'Onvoldoende saldo om deze aankoop te doen.']);
            }

            // saldo verminderen
            $wallet->balance -= $totaal;
            $wallet->save();

            // toevoegen aan portefeuille
            $user->aandelen()->attach($aandeel->id, ['aantal' => $request->aantal]);

            return back()->with('success', 'Aandeel gekocht!');
        } else {
            // GET → toon kooppagina
            $aandelen = Aandeel::all();
            return Inertia::render('Kopen', [
                'aandelen' => $aandelen
            ]);
        }
    }
}
