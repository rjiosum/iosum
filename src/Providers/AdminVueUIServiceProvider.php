<?php declare(strict_types=1);

namespace Iosum\AdminVueUI\Providers;

use Illuminate\Support\ServiceProvider;
use Iosum\AdminVueUI\Console\InstallCommand;
use Iosum\Base\Traits\BaseProvider;


class AdminVueUIServiceProvider extends ServiceProvider
{
    use BaseProvider;

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {

            $theme = config('settings.backend.theme');

            $this->publishes([
                $this->dirPath(__DIR__) . 'resources/views' => resource_path($theme . '/views'),
            ], 'admin-vue-ui-views');

            $this->publishes([
                $this->dirPath(__DIR__) . 'public' => public_path(),
            ], 'admin-vue-ui-assets');

        }
    }

    /**
     * Register any application services.
     *
     */
    public function register(): void
    {
        $this->commands(InstallCommand::class);
    }

}