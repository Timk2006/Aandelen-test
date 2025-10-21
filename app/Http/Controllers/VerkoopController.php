<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aandeel;
use App\Models\Etf;

class VerkoopController extends Controller
{
    public function verkoop(Request $r)
    {
        $r->validate([
            'id' => 'required|integer',
            'type' => 'required|in:aandeel,etf',
            'aantal' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // Bepaal het juiste model & relatie
        $isEtf = $r->type === 'etf';
        $relatie = $isEtf ? $user->etfs() : $user->aandelen();
        $kolom = $isEtf ? 'etf_id' : 'aandeel_id';

        $positie = $relatie->where($kolom, $r->id)->first();

        // Controleer of gebruiker het bezit
        if (!$positie || $positie->pivot->aantal < $r->aantal) {
            return back()->withErrors(['msg' => 'Onvoldoende aantal om te verkopen.']);
        }

        // Bereken nieuw aantal
        $nieuwAantal = $positie->pivot->aantal - $r->aantal;

        // Update of verwijder de pivot
        if ($nieuwAantal > 0) {
            $relatie->updateExistingPivot($r->id, ['aantal' => $nieuwAantal]);
        } else {
            $relatie->detach($r->id);
        }

        // Haal prijs op
        $prijs = ($isEtf ? Etf::find($r->id) : Aandeel::find($r->id))->prijs;

        // Voeg geld toe aan wallet
        $user->wallet->balance += $prijs * $r->aantal;
        $user->wallet->save();

        return back()->with('success', 'Verkoop succesvol uitgevoerd!');
    }
}

