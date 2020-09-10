<?php declare(strict_types=1);

namespace Iosum\AdminVueUI\Providers;


use Illuminate\Http\Request;
use Iosum\AdminVueUI\Console\InstallCommand;
use Iosum\Base\Providers\BaseServiceProvider;


class AdminVueUIServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     * @param Request $request
     */
    public function boot(Request $request): void
    {
        if ($this->app->runningInConsole()) {

            $theme = config('settings.backend.theme');

            $this->publishes([
                $this->dirPath(__DIR__).'resources/views' => resource_path($theme.'/views'),
            ], 'admin-vue-ui-views');

            $this->publishes([
                $this->dirPath(__DIR__).'public' => public_path(),
            ], 'admin-vue-ui-assets');
        }
    }

    /**
     * Register any application services.
     *
     *
     */
    public function register(): void
    {
        $this->commands(InstallCommand::class);
    }

}