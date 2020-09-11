<?php declare(strict_types=1);

namespace Iosum\ApiException\Providers;

use Illuminate\Support\ServiceProvider;
use Iosum\Base\Traits\BaseProvider;


class ApiExceptionServiceProvider extends ServiceProvider
{
    use BaseProvider;

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom($this->dirPath(__DIR__) . 'resources/lang', 'api-exception');

        $this->loadViewsFrom($this->dirPath(__DIR__) . 'resources/views', 'api-exception');
    }

    /**
     * Register any application services.
     *
     */
    public function register(): void
    {

    }

}