<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Etf;

class EtfShowController extends Controller
{
    public function index() {
        $sort = request()->get('sort', 'naam'); // standaard sorteren op naam
        $direction = request()->get('direction', 'asc'); // standaard oplopend
        $etf = \App\Models\Etf::orderBy($sort, $direction)->get();
        return Inertia::render('Etf', ['etf' => $etf, 'sort' => $sort, 'direction' => $direction]);
    }
}
