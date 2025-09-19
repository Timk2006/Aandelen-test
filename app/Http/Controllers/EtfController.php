<?php

namespace App\Http\Controllers;
use App\Models\Etf;
use Inertia\Inertia;

use Illuminate\Http\Request;

class EtfController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'naam');
        $direction = $request->get('direction', 'asc');
        $etfs = Etf::orderBy($sort, $direction)->get();
        return Inertia::render('Etf', [
            'etfs' => $etfs,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }
}

