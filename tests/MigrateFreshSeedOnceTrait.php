<?php
namespace Tests;
use Illuminate\Support\Facades\Artisan;

trait MigrateFreshSeedOnce
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
        "email" => "lramos@gmail.com",
        "password" => "lucas123"
    ];

    /**
    * After the first run of setUp "migrate:fresh --seed"
    * @return void
    */
    public function setUp(): void
    {
        parent::setUp();
        if (!static::$setUpHasRunOnce) {
            Artisan::call('migrate:fresh');
            Artisan::call(
                'db:seed', ['--class' => 'DatabaseSeeder']
            );
            static::$setUpHasRunOnce = true;
        }
    }
}
