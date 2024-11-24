<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class QuoteController extends Controller
{
    private $quotesNum; //Variable to store the number of Quotes obtained from the Kanye Rest API

    private function getQuotes()
    {
        //API Call to get all Quotes from Kanye Rest API
        $quotes = Cache::flexible(
            'quotes',
            [now()->addHour(), now()->addDay()],
            function () {
                $response = Http::get('https://api.kanye.rest/quotes');

                if ($response->failed()) {
                    return "Failed to get quotes";
                }

                return collect($response->json());
            }
        );
        
        //Set the number of Quotes obtained from the Kanye Rest API
        $this->quotesNum = collect($quotes)->count();

        return collect($quotes);
    }

    public function getRandomQuotes($number) //Function to get a number of random Quotes from the Kanye Rest API
    {
        //Get all Quotes from the Kanye Rest API
        $quotes = $this->getQuotes();

        //Check if the Quotes were successfully retrieved
        if ($quotes->count() > 0) {
            //Initialise Collection for Random Quotes
            $randomQuotes = collect();

            //Get $number of random Quotes from the Quotes Collection
            $randomQuotes = $quotes->random($number);

            //Return Collection to the User
            return $randomQuotes;
        }
        //Check if the Quotes were not successfully retrieved
        else {
            return "Failed to get random quotes";
        }
    }

    public function index()
    {
        //Set $number of Quotes to get default to 5
        $number = 5;

        //Get $number of random Quotes from the Kanye Rest API
        $randomQuotes = $this->getRandomQuotes($number);

        //Return the Quotes to the User
        return view('dashboard')->with([
            'quotes' => $randomQuotes
        ]);
    }

    public function show(Request $request)
    {
        //Get the number of Quotes to get from the User
        $number = $request->input('number');

        //Get all Quotes from the Kanye Rest API (ran to set $quotesNum)
        $quotes = $this->getQuotes();

        //Check if number is over limit of $quotes
        if ($number > $this->quotesNum) {
            return json_encode("Number of quotes requested is greater than available quotes"); //Return error message if number is over limit
        }

        //Get $number of random Quotes from the Kanye Rest API
        $randomQuotes = $this->getRandomQuotes($number);
        
        //Return the Collection of Quotes to the Endpoint
        return new JsonResponse($randomQuotes);
        
    }
}
