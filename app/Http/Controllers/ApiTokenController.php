<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(User $user)
    {
        $token = Str::random(60);

        $user->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }

    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if(!$user) {
            return response([
                'repsonse' => 'not found'
            ], 404);
        }

        return response([
            'repsonse' => $this->update($user)
        ], 200);
    }
}
