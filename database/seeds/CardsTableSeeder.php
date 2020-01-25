<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereId(1)->first();

        DB::table('cards')->insert(
            [
                'name' => 'Lucas',
                'attack' => 2,
                'life' => 3,
                'defense' => 1,
                'user_id' => $user->id,
            ]
        );
    }
}
