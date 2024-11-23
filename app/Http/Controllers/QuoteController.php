<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminnate\Http\JsonResponse;

class QuoteController extends Controller
{
    public function getQuotes()
    {
        $quotes = []; //Array to store quotes

        for ($i = 0; $i < 5; $i++) { //Loop for 5 Quotes
            //Get Quotes from API (Returns JSON as per Docs)
            $response = Http::get('https://api.kanye.rest');

            //Check if the request was successful
            if ($response->successful()) {
                //Add Quote to Array
                $quotes[] = $response->json()['quote'];
            } else {
                //Return Error if request failed
                return response()->json(['error' => 'Failed to get quotes'], 500);
            }
        }
        return response()->json(['quotes' => $quotes], 200); //Return Quotes
    }
}
