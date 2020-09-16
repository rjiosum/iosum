<?php declare(strict_types=1);

namespace Iosum\AdminAuth\Tests;

use Iosum\AdminAuth\Providers\AdminAuthServiceProvider;
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
        $this->withFactories(__DIR__.'/../database/factories');

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
            AdminAuthServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app->register(PassportServiceProvider::class);
    }

    public function create(string $class, array $attributes = [], int $times = null)
    {
        return factory($class, $times)->create($attributes);
    }

    public function make(string $class, array $attributes = [], int $times = null)
    {
        return factory($class, $times)->make($attributes);
    }

    public function raw(string $class, array $attributes = [], int $times = null)
    {
        return factory($class, $times)->raw($attributes);
    }
}
