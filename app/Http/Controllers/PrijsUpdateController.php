<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aandeel;

class PrijsUpdateController extends Controller
{
    public function update()
    {
        foreach (Aandeel::all() as $aandeel) {
            $aandeel->prijs = rand(5, 100); // Of je eigen logica/API
            $aandeel->save();
        }
        return response()->json(['success' => true]);
    }
}
