<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;
use Tests\Traits\RefreshDatabaseWithSeeds;
use Tests\WithUser;

class CardTest extends TestCase
{

    use RefreshDatabaseWithSeeds, WithFaker, WithUser;

    /**
     * A basic feature test example.
     *
     * @group  card
     * @return void
     */
    public function testCardCreation()
    {
        $cards = [];

        for ($i=0; $i < 10; $i++) {
            $cards[] = [
                "name" => $this->faker()->name,
                "attack" => $this->faker()->randomDigit,
                "life" => $this->faker()->randomDigit,
                "defense" => $this->faker()->randomDigit
            ];
        }

        $response = $this->withHeaders(
            ['Authorization' => 'Bearer '.static::$userToken]
        )->json(
            'POST',
            '/api/card',
            $cards
        );

        $response
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'message',
                    'cards' => [
                        '*' => [
                            "name",
                            "attack",
                            "life",
                            "defense",
                            "user_id",
                            "updated_at",
                            "created_at",
                            "id",
                        ]
                    ]
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @group  card
     * @return void
     */
    public function testCardUpdate()
    {
        $card = [
            "name" => $this->faker()->name,
            "attack" => $this->faker()->randomDigit,
            "life" => $this->faker()->randomDigit,
            "defense" => $this->faker()->randomDigit
        ];

        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer '.static::$userToken,
                'Content-Type' => 'application/json',
            ]
        )->json(
            'PUT',
            '/api/card/' . rand(0, 10),
            $card
        );

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'response' => 'Card Updated',
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @group  card
     * @return void
     */
    public function testCardDelete()
    {
        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer '.static::$userToken
            ]
        )->json('DELETE', '/api/card/' . rand(0, 10));

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'response' => 'Card Deleted',
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @group  card
     * @return void
     */
    public function testCardList()
    {
        $response = $this->withHeaders(
            [
                'Authorization' => 'Bearer '.static::$userToken
            ]
        )->json('GET', '/api/card/');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    '*' => [
                        "id",
                        "name",
                        "attack",
                        "life",
                        "defense",
                        "created_at",
                        "updated_at",
                    ]
                ]
            );
    }
}
