<?php declare(strict_types=1);

namespace Iosum\AdminNav\Providers;

use Illuminate\Support\ServiceProvider;
use Iosum\AdminNav\Actions\CreateAdminNavigation;
use Iosum\AdminNav\Actions\DeleteAdminNavigation;
use Iosum\AdminNav\Actions\FetchAdminNavigation;
use Iosum\AdminNav\Actions\FetchAdminNavigationTree;
use Iosum\AdminNav\Actions\FindAdminNavigation;
use Iosum\AdminNav\Actions\UpdateAdminNavigation;
use Iosum\AdminNav\Contracts\CreateAdminNavigation as CreateAdminNavigationInterface;
use Iosum\AdminNav\Contracts\DeleteAdminNavigation as DeleteAdminNavigationInterface;
use Iosum\AdminNav\Contracts\FetchAdminNavigation as FetchAdminNavigationInterface;
use Iosum\AdminNav\Contracts\FetchAdminNavigationTree as FetchAdminNavigationTreeInterface;
use Iosum\AdminNav\Contracts\FindAdminNavigation as FindAdminNavigationInterface;
use Iosum\AdminNav\Contracts\UpdateAdminNavigation as UpdateAdminNavigationInterface;
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
