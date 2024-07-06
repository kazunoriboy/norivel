<?php

namespace Illuminate\Foundation;

use Illuminate\Container\Container;

class Application extends Container
{
    public static function configure(?string $basePath = null)
    {
        $basePath = match (true) {
            is_string($basePath) => $basePath,
            default => static::inferBasePath(),
        };

        return (new Configuration\ApplicationBuilder(new static($basePath)))
            ->withKernel()
            ->withEvents()
            ->withCommands()
            ->withProviders();
    }

    public static function inferBasePath()
    {
        return match (true) {
            isset($_ENV['APP_BASE_PATH']) => $_ENV['APP_BASE_PATH'],
            default => dirname(array_keys(ClassLoader::getRegisteredLoaders())[0]),
        };
    }
   
}
