<?php declare(strict_types=1);


namespace Iosum\ApiException\Providers;


use Illuminate\Http\Request;
use Iosum\Base\Providers\BaseServiceProvider;


class ApiExceptionServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     * @param Request $request
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot(Request $request): void
    {
        $this->loadTranslationsFrom($this->dirPath(__DIR__) . 'resources/lang', 'api-exception');

        $this->loadViewsFrom($this->dirPath(__DIR__).'resources/views', 'api-exception');
    }

    /**
     * Register any application services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(): void
    {

    }

}