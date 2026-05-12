<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function send(Request $request)
    {
        $userMessage = $request->input('message');
        $resident = auth()->user();

        // Contexte personnalisé pour le résident
        $contexte = "Tu es l'assistant virtuel du Syndic SyndicPro.
Tu parles au résident : {$resident->name}.
IMPORTANT : Ne commence JAMAIS tes réponses par 'Bonjour' ou une salutation.
Va directement à la réponse, de façon courte et professionnelle.
Tu aides uniquement pour : factures, réclamations, réunions, annonces, paiements.";

        $response = Http::post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key='
            . env('GEMINI_API_KEY'),
            [
                'system_instruction' => [
                    'parts' => [['text' => $contexte]]
                ],
                'contents' => [[
                    'parts' => [['text' => $userMessage]]
                ]]
            ]
        );

        $texte = $response['candidates'][0]['content']['parts'][0]['text'];

        return response()->json(['reply' => $texte]);
    }
}