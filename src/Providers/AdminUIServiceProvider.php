<?php declare(strict_types=1);

namespace Iosum\AdminUI\Providers;


use Illuminate\Http\Request;
use Iosum\AdminUI\Console\InstallCommand;
use Iosum\Base\Providers\BaseServiceProvider;


class AdminUIServiceProvider extends BaseServiceProvider
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
                $this->dirPath(__DIR__).'resources/views' => base_path('resources/backend/'.$theme.'/views'),
            ], 'views');

            $this->publishes([
                $this->dirPath(__DIR__).'public' => public_path('backend/'.$theme),
            ], 'admin-assets');
        }

        $this->loadViewsFrom($this->dirPath(__DIR__).'resources/views', 'admin');
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