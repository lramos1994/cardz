<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    protected $user = [
        "name" => "Lucas Ramos",
        "email" => "lramos@gmail.com",
        "password" => "lucas123"
    ];

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
            $this->user
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
     * @return void
     */
    public function testUserLogin()
    {
        $this->testUserCreation();

        $response = $this->json(
            'POST',
            '/api/user/login',
            [
                "email" => $this->user['email'],
                "password" => $this->user['password']
            ]
        );

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
}
