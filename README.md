# Admin Auth

### Steps:
- Run following commands:
```bash
php artisan migrate
php artisan passport:install
php artisan passport:client --password --provider=admins

php artisan admin-vue-ui:install

php artisan storage:link
```

- Add following inside boot method of app/Providers/AuthServiceProvider.php:

```php

Passport::routes(function ($router) {
    $router->forAccessTokens();
});

```

- To Seed database add following in DatabaseSeeder.php:
```php
    $this->call(AdminSeeder::class);
    $this->call(AdminNavigationSeeder::class);
```

- In web.php add:
```php
Route::view('/'.config('settings.backend.route').'/{parameters?}', 'admin')->where('parameters', '.*');
```

- In app/Exceptions/Handler.php add:
```php

use Iosum\ApiException\Traits\ApiHandler;
use Throwable;


class Handler extends ExceptionHandler
{
    use ApiHandler;

    //.........


    public function render($request, Throwable $exception)
    {
        if($request->expectsJson()) {
            return $this->resolve($request, $exception);
        }
        return parent::render($request, $exception);
    }
}

```