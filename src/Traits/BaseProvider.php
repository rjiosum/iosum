<?php declare(strict_types=1);

namespace Iosum\Base\Traits;


use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Support\Arr;

trait BaseProvider
{
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