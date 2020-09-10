<?php declare(strict_types=1);

namespace Iosum\Base\Providers;

use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Iosum\Base\Repositories\BaseRepository;
use Iosum\Base\Repositories\BaseRepositoryInterface;
use Iosum\Base\Services\HelperService;

class BaseServiceProvider extends ServiceProvider
{
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

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param string $path
     * @param string $key
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function mergeConfigFrom($path, $key): void
    {
        if (!($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            $config = $this->app->make('config')->get($key, []);

            $this->app->make('config')->set($key, $this->mergeConfig(require $path, $config));
        }
    }

    /**
     * Merges the configs together and takes multi-dimensional arrays into account.
     *
     * @param array $original
     * @param array $merging
     * @return array
     */
    protected function mergeConfig(array $original, array $merging): array
    {
        $array = array_merge($original, $merging);

        foreach ($original as $key => $value) {
            if (!is_array($value)) {
                continue;
            }

            if (!Arr::exists($merging, $key)) {
                continue;
            }

            if (is_numeric($key)) {
                continue;
            }

            $array[$key] = $this->mergeConfig($value, $merging[$key]);
        }

        return $array;
    }

    /**
     * Resource loading path
     *
     * @param $current
     * @return string
     */
    protected function dirPath($current): string
    {
        return $current.'/../../';
    }
}