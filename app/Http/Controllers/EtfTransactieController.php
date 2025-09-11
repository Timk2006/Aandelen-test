<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactieModel;

class EtfTransactieController extends Controller
{
    public function buy(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'etf_id' => 'required|exists:etfs,id',
            'aantal' => 'required|integer|min:1',
            'prijs_per_stuk' => 'required|numeric|min:0',
        ]);

        $totaalprijs = $request->aantal * $request->prijs_per_stuk;

        if (!$user->wallet || $user->wallet->balance < $totaalprijs) {
            return redirect()->back()->with('error', 'Onvoldoende saldo in je wallet.');
        }

        $user->wallet->balance -= $totaalprijs;
        $user->wallet->save();

        TransactieModel::create([
            'user_id' => $user->id,
            'etf_id' => $request->etf_id,   // let op: kolom `etf_id` moet in je TransactieModel bestaan!
            'aantal' => $request->aantal,
            'prijs_per_stuk' => $request->prijs_per_stuk,
            'type' => 'buy',
        ]);

        return redirect()->back()->with('success', 'ETF succesvol gekocht!');
    }
}

