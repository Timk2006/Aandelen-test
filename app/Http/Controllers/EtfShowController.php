<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Etf;

class EtfShowController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'naam');
        $direction = $request->get('direction', 'asc');

        $allowedSorts = ['naam', 'prijs'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'naam';
        }

        $etfs = Etf::orderBy($sort, $direction)->get();

        return Inertia::render('Etf', [
            'etfs' => $etfs,
            'sort' => $sort,
            'direction' => $direction
        ]);
    }
}

