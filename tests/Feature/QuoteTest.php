<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class QuoteTest extends TestCase
{
    public function test_dashboard_is_displayed(): void //Test to confirm return of dashboard view
    {
        //Create a user
        $user = User::factory()->create();

        //Use user to access the dashboard
        $response = $this->actingAs($user)->get('/');

        //Check that the response is successful
        $response->assertStatus(200);
    }

    public function test_quote_is_displayed(): void //Test to confirm return of 1 quote
    {
        //Request all quotes from the local API
        $response = $this->getJson('/api/quotes');

        //Check that the response is successful
        $response->assertStatus(200);

        //Decode the response JSON into an array
        $quote = $response->json();

        //Ensure the quote is a string
        $this->assertIsString($quote);
    }

    public function test_return_of_five_quotes(): void //Test to confirm return of 5 quotes
    {
        //Request multiple quotes from the API
        $response = $this->getJson('/api/quotes?number=5'); //Pass a number to the query string

        //Check that the response is successful
        $response->assertStatus(200);

        //Decode the response JSON into an array
        $quotes = $response->json();

        //Check for the correct number of quotes
        $this->assertCount(5, $quotes);

        //Ensure each quote is a string
        foreach ($quotes as $quote) {
            $this->assertIsString($quote);
        }
    }
}
