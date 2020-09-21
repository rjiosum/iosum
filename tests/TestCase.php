<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests;

use Iosum\AdminAuth\Providers\AdminAuthServiceProvider;
use Iosum\AdminNav\Providers\AdminNavigationServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public $mockConsoleOutput = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->artisan('migrate:fresh');

        $this->artisan('passport:install -q');
        $this->artisan('passport:client --password --provider=admins -n -q');

        Passport::routes(function ($router) {
            $router->forAccessTokens();
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminNavigationServiceProvider::class,
            AdminAuthServiceProvider::class,
            PassportServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }

    public function create(string $class, array $attributes = [], int $times = null)
    {
        return $class::factory($times)->create($attributes);
    }

    public function make(string $class, array $attributes = [], int $times = null)
    {
        return $class::factory($times)->make($attributes);
    }

    public function raw(string $class, array $attributes = [], int $times = null)
    {
        return $class::factory($times)->raw($attributes);
    }
}
