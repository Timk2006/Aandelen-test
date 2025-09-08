<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AandeelTransactieController extends Controller
{
    public function buy(Request $request) {
      $user = auth()->user();
     
      if (!$user->wallet || $user->wallet->balance < ($request->aantal * $request->prijs_per_stuk)) {
          return redirect()->back()->with('error', 'Onvoldoende saldo in je wallet.');
      }
      
$user->wallet->balance -= $totaalprijs;
      $user->wallet->save();
      Transaction::create([
          'user_id' => $user->id,
          'aandeel_id' => $request->aandeel_id,
          'aantal' => $request->aantal,
          'prijs_per_stuk' => $request->prijs_per_stuk,
          'type' => 'buy',
      ]);

      return redirect()->back()->with('success', 'Aandelen gekocht!');
    }
}
