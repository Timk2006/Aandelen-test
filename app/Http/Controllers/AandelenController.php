<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Aandeel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class AandelenController extends Controller
{
    public function index() {
        $sort = request()->get('sort', 'naam'); 
        $direction = request()->get('direction', 'asc'); 
        $aandelen = \App\Models\Aandeel::orderBy($sort, $direction)->get();
        return Inertia::render('Aandelen', ['aandelen' => $aandelen, 'sort' => $sort, 'direction' => $direction]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aandeel $aandeel): RedirectResponse
    {
        $user = Auth::user();
        if (! $user || ! ($user->is_admin ?? false)) {
            abort(403);
        }

        $aandeel->delete();

        return redirect()->route('aandelen')->with('success', 'Aandeel verwijderd.');
    }
}
