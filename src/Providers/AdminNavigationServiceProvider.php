<?php declare(strict_types=1);

namespace Iosum\AdminNav\Providers;

use Illuminate\Support\ServiceProvider;
use Iosum\AdminNav\Actions\{
    CreateAdminNavigation,
    DeleteAdminNavigation,
    FetchAdminNavigation,
    FetchAdminNavigationTree,
    FindAdminNavigation,
    UpdateAdminNavigation
};
use Iosum\AdminNav\Contracts\{
    FetchAdminNavigation as FetchAdminNavigationInterface,
    FindAdminNavigation as FindAdminNavigationInterface,
    CreateAdminNavigation as CreateAdminNavigationInterface,
    UpdateAdminNavigation as UpdateAdminNavigationInterface,
    DeleteAdminNavigation as DeleteAdminNavigationInterface,
    FetchAdminNavigationTree as FetchAdminNavigationTreeInterface
};
use Iosum\Base\Traits\BaseProvider;

class AdminNavigationServiceProvider extends ServiceProvider
{
    use BaseProvider;

    protected $actions = [
        FetchAdminNavigationInterface::class => FetchAdminNavigation::class,
        FetchAdminNavigationTreeInterface::class => FetchAdminNavigationTree::class,
        FindAdminNavigationInterface::class => FindAdminNavigation::class,
        CreateAdminNavigationInterface::class => CreateAdminNavigation::class,
        UpdateAdminNavigationInterface::class => UpdateAdminNavigation::class,
        DeleteAdminNavigationInterface::class => DeleteAdminNavigation::class,
    ];

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        $this->loadRoutesFrom($this->dirPath(__DIR__) . 'routes/admin-nav.php');

        $this->loadMigrationsFrom($this->dirPath(__DIR__) . 'database/migrations');

        //$this->loadTranslationsFrom($this->dirPath(__DIR__) . 'resources/lang', 'xxx');


    }

    /**
     * Register any application services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(): void
    {
        foreach ($this->actions as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }

        /*$this->mergeConfigFrom(
            $this->dirPath(__DIR__) . 'config/xxx.php', 'xxx'
        );*/


    }

}