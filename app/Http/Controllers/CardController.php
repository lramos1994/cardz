<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;

class CardController extends Controller
{
    /**
     * return the cards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function get(Request $request)
    {
        return Card::all();
    }

    /**
     * create the cards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function create(Request $request)
    {
        $cards = $request->validate(
            [
                '*.name' => 'required',
                '*.attack' => 'required|integer',
                '*.life' => 'required|integer',
                '*.defense' => 'required|integer',
            ]
        );

        foreach ($cards as $key => &$card) {
            $card['user_id'] = $request->user()->id;
        }

        if(Card::insert($cards)) {
            // TODO: implements better return body
            return response(
                ['message' => 'Registered Cards: '.count($cards)],
                201
            );
        }
    }

    /**
     * Update a card.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'attack' => 'required|integer',
            'life' => 'required|integer',
            'defense' => 'required|integer',
        ]);

        $card = Card::whereId($request->id)->first();

        if(!$card)
            return response(['response' => 'Not Found'], 404);

        $card->name = $validated['name'];
        $card->attack = $validated['attack'];
        $card->life = $validated['life'];
        $card->defense = $validated['defense'];

        if($card->save()) {
            return response([
                'response' => 'Card Updated'
            ], 200);
        }

        return response([
            'response' => 'No Response'
        ], 400);
    }

    /**
     * Delete a card.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function delete(Request $request)
    {
        $card = Card::whereId($request->id)->first();

        if(!$card)
            return response(['response' => 'Not Found'], 404);

        if($card->delete()) {
            return response([
                'response' => 'Card Deleted'
            ], 200);
        }

        return response([
            'response' => 'No Response'
        ], 400);
    }
}
