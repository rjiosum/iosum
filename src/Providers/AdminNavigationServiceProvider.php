<?php declare(strict_types=1);

namespace Iosum\AdminNav\Providers;

use Hashids\Hashids;
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
    CreateAdminNavigationInterface,
    DeleteAdminNavigationInterface,
    FetchAdminNavigationInterface,
    FetchAdminNavigationTreeInterface,
    FindAdminNavigationInterface,
    UpdateAdminNavigationInterface
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
    }

    /**
     * Register any application services.
     *
     */
    public function register(): void
    {
        foreach ($this->actions as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
