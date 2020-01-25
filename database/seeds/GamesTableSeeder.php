<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereId(1)->first();

        for ($i=0; $i < 2; $i++) {
            DB::table('games')->insert([
                'name' => Str::random(20),
                'attack' => 'Ataque',
                'life' => 'Vida',
                'defense' => 'Defesa',
                'user_id' => $user->id
            ]);
        }
    }
}
