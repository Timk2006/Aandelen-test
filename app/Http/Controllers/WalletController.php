<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WalletController extends Controller
{
public function handle(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

    if ($request->isMethod('post')) {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $wallet = $user->wallet;
        $wallet->balance += $request->amount;
        $wallet->save();

        return redirect()->back()->with('success', 'Saldo succesvol toegevoegd!');
    }

    return Inertia::render('Wallet', [
        'balance' => (float) $user->wallet->balance,
        'csrfToken' => csrf_token(), 
    ]);
}
}