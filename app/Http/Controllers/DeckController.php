<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deck;

class DeckController extends Controller
{
    /**
     * return the decks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function get(Request $request)
    {
        return Deck::all();
    }

    /**
     * create the decks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $deck = new Deck();
        $deck->name = $request->name;
        $deck->user_id = $request->user()->id;

        if($deck->save()) {
            // TODO: implements better return body
            return response([
                'repsonse' => 'Registered Decks: 1'
            ], 201);
        }
    }

    /**
     * Update a deck.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $deck = Deck::whereId($request->id)->whereUserId($request->user()->id)->first();

        if(!$deck)
            return response(['repsonse' => 'Not Found'], 404);

        $deck->name = $validated['name'];

        if($deck->save()) {
            return response([
                'repsonse' => 'Deck Updated'
            ], 200);
        }

        return response([
            'repsonse' => 'No Response'
        ], 400);
    }

    /**
     * Delete a deck.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function delete(Request $request)
    {
        $deck = Deck::whereId($request->id)->whereUserId($request->user()->id)->first();

        if(!$deck)
            return response(['repsonse' => 'Not Found'], 404);

        if($deck->delete()) {
            return response([
                'repsonse' => 'Card Deleted'
            ], 200);
        }

        return response([
            'repsonse' => 'No Response'
        ], 400);
    }
}
