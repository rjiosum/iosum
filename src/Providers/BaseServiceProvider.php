<?php declare(strict_types=1);

namespace Iosum\Base\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Iosum\Base\Repositories\BaseRepository;
use Iosum\Base\Repositories\BaseRepositoryInterface;
use Iosum\Base\Services\HelperService;
use Iosum\Base\Traits\BaseProvider;

class BaseServiceProvider extends ServiceProvider
{
    use BaseProvider;

    protected array $repositories = [
        BaseRepositoryInterface::class => BaseRepository::class
    ];

    /**
     * Register any application services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }

        $this->app->bind('HelperService', function () {
            return new HelperService();
        });

        $this->mergeConfigFrom(
            $this->dirPath(__DIR__) . 'config/settings.php', 'settings'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @param Request $request
     */
    public function boot(Request $request): void
    {
        $collection = $request->segments();

        $route = config('settings.backend.route');
        $frontend = config('settings.frontend.theme');
        $backend = config('settings.backend.theme');

        $path = resource_path($frontend . '/views');

        if (in_array($route, $collection)) {
            $path = resource_path($backend . '/views');
        }

        view()->addLocation($path);
    }
}