<?php
namespace Tests;
use Illuminate\Support\Facades\Artisan;

trait WithUser
{
    /**
    * If true, setup has run at least once.
    * @var boolean
    */
    protected static $setUpHasRunOnce = false;

    /**
    * If true, setup has run at least once.
    * @var boolean
    */
    protected static $user = [
        "name" => "Lucas Ramos",
        "email" => "lramos@test.com",
        "password" => "teste123"
    ];

    /**
    * If true, setup has run at least once.
    * @var boolean
    */
    protected static $userCredencials = [
        "email" => "teste@gmail.com",
        "password" => "teste123"
    ];

    protected static $userLogged = false;

    protected static $userToken;

    /**
    * After the first run of setUp "migrate:fresh --seed"
    * @return void
    */
    public function setUp(): void
    {
        parent::setUp();

        if (!static::$userLogged) {
            $response = $this->json(
                'POST',
                '/api/user/login',
                [
                    "email" => static::$userCredencials['email'],
                    "password" => static::$userCredencials['password']
                ]
            );

            if (isset($response['response']['token'])) {
                static::$userToken = $response['response']['token'];
                static::$userLogged = true;
            }
        }
    }
}
