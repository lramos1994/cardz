<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\MigrateFreshSeedOnce;
use Tests\TestCase;

class UserTest extends TestCase
{

    use MigrateFreshSeedOnce;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCreation()
    {
        $response = $this->json(
            'POST',
            '/api/user',
            static::$user
        );

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'response' => "User Created.",
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @depends testUserCreation
     * @return void
     */
    public function testUserLogin()
    {
        $response = $this->json(
            'POST',
            '/api/user/login',
            [
                "email" => static::$user['email'],
                "password" => static::$user['password']
            ]
        );

        static::$user['token'] = $response['response']['token'];

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'response' => [
                        "token",
                    ],
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @depends testUserCreation
     * @return void
     */
    public function testUserCredencials()
    {
        $response = $this->withHeaders(
            ['Authorization' => 'Bearer '.static::$user['token']]
        )->get('/api/user');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    "name",
                    "email",
                ]
            );
    }
}
