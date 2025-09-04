<?php

namespace App\Http\Controllers;
use App\Models\Etf;
use Inertia\Inertia;

use Illuminate\Http\Request;

class EtfController extends Controller
{
    public function index()
    {
        $etfs = Etf::all();
        return Inertia::render('Etf', [
            'etfs' => $etfs
        ]);
    }
}

