<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminnate\Http\JsonResponse;

class QuoteController extends Controller
{
    private function getQuotes() //Function to get all Quotes from Kanye Rest API
    {
        //API Call to get all Quotes from Kanye Rest API
        $response = Http::get('api.kanye.rest/quotes');

        //Check if the API call was successful
        if ($response->successful()) {
            //Initialise Collection for Quotes
            $quotes = collect();

            //Loop through the quotes and add them to the collection
            foreach ($response->json() as $quote) {
                $quotes->push($quote);
            }

            //Return Collection
            return $quotes;

            //Check if the API call was not successful
        } else {
            return "Failed to get quotes";
        }
    }

    private function getRandomQuotes($number) //Function to get a number of random Quotes from the Kanye Rest API
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
        return view('dashboard')->with(
            'quotes', $randomQuotes
        );
    }
}
