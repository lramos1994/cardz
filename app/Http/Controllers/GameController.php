<?php

namespace App\Http\Controllers;

use App\Deck;
use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    /**
     * return the Games.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function get(Request $request)
    {
        return Game::all();
    }

    /**
     * create the decks.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'decks' => 'required|array'
        ]);

        $user = $request->user();

        $decks = Deck::whereIN('id', $validated['decks'])->whereUserId($user->id)->get();

        $game = new Game;
        $game->name = $request->name;
        $game->attack = $request->attack;
        $game->life = $request->life;
        $game->defence = $request->defence;
        $game->user_id = $user->id;

        if($game->save()) {
            $game->decks()->saveMany($decks);
            // TODO: implements better return body
            return response([
                'repsonse' => 'Registered Games: 1'
            ], 201);
        }
    }

    // /**
    //  * Update a deck.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    // public function update(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required'
    //     ]);

    //     $deck = Deck::whereId($request->id)->whereUserId($request->user()->id)->first();

    //     if(!$deck)
    //         return response(['repsonse' => 'Not Found'], 404);

    //     $deck->name = $validated['name'];

    //     if($deck->save()) {
    //         return response([
    //             'repsonse' => 'Deck Updated'
    //         ], 200);
    //     }

    //     return response([
    //         'repsonse' => 'No Response'
    //     ], 400);
    // }

    // /**
    //  * Delete a deck.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return array
    //  */
    // public function delete(Request $request)
    // {
    //     $deck = Deck::whereId($request->id)->whereUserId($request->user()->id)->first();

    //     if(!$deck)
    //         return response(['repsonse' => 'Not Found'], 404);

    //     if($deck->delete()) {
    //         return response([
    //             'repsonse' => 'Card Deleted'
    //         ], 200);
    //     }

    //     return response([
    //         'repsonse' => 'No Response'
    //     ], 400);
    // }
}
