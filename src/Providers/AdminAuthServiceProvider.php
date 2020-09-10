<?php declare(strict_types=1);


namespace Iosum\AdminAuth\Providers;

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Iosum\Base\Providers\BaseServiceProvider;


class AdminAuthServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     * @param Request $request
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot(Request $request): void
    {
        $this->loadRoutesFrom($this->dirPath(__DIR__) . 'routes/admin-auth.php');

        $this->loadFactoriesFrom($this->dirPath(__DIR__) . 'database/factories');

        $this->loadMigrationsFrom($this->dirPath(__DIR__) . 'database/migrations');

        $this->loadTranslationsFrom($this->dirPath(__DIR__) . 'resources/lang', 'admin-auth');

        $router = $this->app->make(Router::class);
        $router->middlewareGroup(
            'api.admin', [
            \Iosum\AdminAuth\Http\Middleware\AdminAuthHeader::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            $this->dirPath(__DIR__) . 'config/passport.php', 'passport'
        );

        $this->mergeConfigFrom(
            $this->dirPath(__DIR__) . 'config/auth.php', 'auth'
        );
    }


}