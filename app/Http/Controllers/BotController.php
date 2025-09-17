<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    public function vraag(Request $request)
    {
        Log::info('Bot request', $request->all());
        $vraag = $request->input('vraag');
        $onderwerp = $request->input('onderwerp');

        $response = Http::post('https://purplecore.app.n8n.cloud/webhook-test/826b51b6-7a40-4002-89c9-1582d89748c2', [
            'vraag' => $vraag,
            'onderwerp' => $onderwerp,
            'session_id' => session()->getId(),
        ]);

        $antwoord = $response->json()['output'] ?? 'Geen antwoord ontvangen';
        // Sla op in sessie voor debuggen
        session(['bot_debug' => [
            'vraag' => $vraag,
            'onderwerp' => $onderwerp,
            'antwoord' => $antwoord,
        ]]);
        return response()->json([
            'vraag' => $vraag,
            'onderwerp' => $onderwerp,
            'antwoord' => $antwoord,
        ]);
    }
}
