<?php

namespace App\Http\Controllers;
use App\Models\Etf;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;





class EtfKoopController extends Controller
{
public function handle(Request $request)
{
    if ($request->isMethod('post')) {
        $request->validate([
            'etf_id' => 'required|exists:etfs,id',
            'aantal' => 'required|integer|min:1',
        ]);

        $user   = Auth::user();
        $wallet = $user->wallet;
        $etf    = Etf::find($request->etf_id);
        $totaal = $etf->prijs * $request->aantal;

        if ($wallet->balance < $totaal) {
            return back()->withErrors(['saldo' => 'Onvoldoende saldo om deze aankoop te doen.']);
        }

        $wallet->balance -= $totaal;
        $wallet->save();

        $user->Etf()->attach($etf->id, ['aantal' => $request->aantal]);

        return back()->with('success', 'ETF gekocht!');
    }

    $sort = $request->query('sort', 'naam');
    $direction = $request->query('direction', 'asc');

    $etfs = Etf::orderBy($sort, $direction)->get();
    $aandelen = \App\Models\Aandeel::orderBy('naam', 'asc')->get();

    return Inertia::render('KopenEtf', [
        'etfs' => $etfs,
        'sort' => $sort,
        'direction' => $direction,
    ]);
}
}
?>