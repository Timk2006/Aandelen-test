<?php

namespace App\Http\Controllers;
use Inertia\Inertia;


class AandelenController extends Controller
{
    public function index() {
        $sort = request()->get('sort', 'naam'); // standaard sorteren op naam
        $direction = request()->get('direction', 'asc'); // standaard oplopend
        $aandelen = \App\Models\Aandeel::orderBy($sort, $direction)->get();
        return Inertia::render('Aandelen', ['aandelen' => $aandelen, 'sort' => $sort, 'direction' => $direction]);
    }
}
