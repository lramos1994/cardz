<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deck;
use App\Card;
use Illuminate\Support\Arr;

class DeckController extends Controller
{
    /**
     * return the decks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function get(Request $request, $id = false)
    {
        if ($id) {
            $deck = Deck::whereId($id)->first();
            if ($deck) {
                return $deck;
            }
            return response(['response' => 'Not Found'], 404);
        }

        return Deck::whereUserId($request->user()->id)->get();
    }

    /**
     * create the decks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function create(Request $request)
    {
        $request->validate(
            ['name' => 'required']
        );

        $deck = new Deck();
        $deck->name = $request->name;
        $deck->user_id = $request->user()->id;

        if($deck->save()) {

            $cards = [];
            foreach ($request->cards as $key => $card) {
                $cards[] = Card::where($card)->first();
            }

            $deck->cards()->saveMany($cards);

            // TODO: implements better return body
            return response([
                'response' => 'Registered Decks: 1'
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

        $deck = Deck::where(
            ['id' => $request->id, 'user_id' => $request->user()->id]
        )->first();

        if (!$deck)
            return response(['response' => 'Not Found'], 404);

        $deck->name = $validated['name'];

        $cards = Arr::pluck($request->cards, 'id');

        $deck->cards()->sync($cards);

        if ($deck->save()) {
            return response(['response' => 'Deck Updated'], 200);
        }

        return response(['response' => 'No Response'], 400);
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
            return response(['response' => 'Not Found'], 404);

        if($deck->delete()) {
            return response([
                'response' => 'Card Deleted'
            ], 200);
        }

        return response([
            'response' => 'No Response'
        ], 400);
    }
}
