<?php declare(strict_types=1);

namespace Iosum\AdminNav\Tests;

use Iosum\AdminAuth\Providers\AdminAuthServiceProvider;
use Iosum\AdminNav\Providers\AdminNavigationServiceProvider;
use Iosum\Base\Providers\BaseServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\PassportServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use WithFaker;

    public $mockConsoleOutput = false;
    protected $admin;

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

        $this->admin = $this->create('Iosum\AdminAuth\Models\Admin',  ['email' => 'raj@test.com']);
        Passport::actingAs($this->admin, [], 'api:admin');
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminNavigationServiceProvider::class,
            AdminAuthServiceProvider::class,
            PassportServiceProvider::class,
            BaseServiceProvider::class
        ];
    }

    public function getEnvironmentSetUp($app)
    {
    }

    public function data($data = []): array
    {
        return [
            'parent_id' => $data['parent_id'] ?? 0,
            'position' => $data['position'] ?? 1,
            'title' => $data['title'] ?? $this->faker->text(40),
            'route_name' => $data['route_name'] ?? 'na',
            'route_path' => $data['route_path'] ?? 'na',
        ];
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
