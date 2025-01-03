<?php

namespace Illuminate\Foundation\Configuration;

use Illuminate\Foundation\Application;

class ApplicationBuilder
{
    public function __construct(protected Application $app)
    {
    }

    public function withKernel()
    {
        $this->app->singleton(
            \Illuminate\Contracts\Http\Kernel::class,
            \Illuminate\Foundation\Http\Kernel::class,
        );

        // $this->app->singleton(
            // \Illuminate\Contracts\Console\Kernel::class,
            // \Illuminate\Foundation\Console\Kernel::class,
        // );

        return $this;
    }

    public function withProviders(array $providers = [], bool $withBootstrapProviders = true)
    {
        // RegisterProviders::merge(
            // $providers,
            // $withBootstrapProviders
                // ? $this->app->getBootstrapProvidersPath()
                // : null
        // );

        return $this;
    }

    public function withEvents(array|bool $discover = [])
    {
        // if (is_array($discover) && count($discover) > 0) {
            // AppEventServiceProvider::setEventDiscoveryPaths($discover);
        // }

        // if ($discover === false) {
            // AppEventServiceProvider::disableEventDiscovery();
        // }

        // if (! isset($this->pendingProviders[AppEventServiceProvider::class])) {
            // $this->app->booting(function () {
                // $this->app->register(AppEventServiceProvider::class);
            // });
        // }

        // $this->pendingProviders[AppEventServiceProvider::class] = true;

        return $this;
    }

    public function withRouting(?Closure $using = null,
        array|string|null $web = null,
        array|string|null $api = null,
        ?string $commands = null,
        ?string $channels = null,
        ?string $pages = null,
        ?string $health = null,
        string $apiPrefix = 'api',
        ?callable $then = null
    ) {
        // if (is_null($using) && (is_string($web) || is_array($web) || is_string($api) || is_array($api) || is_string($pages) || is_string($health) || is_callable($then)) {
            // $using = $this->buildRoutingCallback($web, $api, $pages, $health, $apiPrefix, $then);
        // }

        // AppRouteServiceProvider::loadRoutesUsing($using);

        // $this->app->booting(function () {
            // $this->app->register(AppRouteServiceProvider::class, force: true);
        // });

        // if (is_string($commands) && realpath($commands) !== false) {
            // $this->withCommands([$commands]);
        // }

        // if (is_string($channels) && realpath($channels) !== false) {
            // $this->withBroadcasting($channels;)
        // }

        return $this;
    }

    public function withMiddleware(?callable $callback = null)
    {
        // $this->app->afterResolving(HttpKernel::class, function ($kernel) use ($callback) {
            // $middleware = (new Middleware)
                // ->redirectGuestsTo(fn () => route('login'));

            // if (! is_null($callback)) {
                // $callback($middleware);
            // }

            // $this->pageMiddleware = $middleware->getPageMiddleware();
            // $kernel->setGlobalMiddleware($middleware->getGlobalMiddleware());
            // $kernel->setMiddlewareGroups($middleware->getMiddlewareGroups());
            // $kernel->setMiddlewareAliases($middleware->getMiddlewareAliases());

            // if ($priorities = $middleware->getMiddlewarePriority()) {
                // $kernel->setMiddlewarePriority($priorities);
            // }
        // });

        return $this;
    }
    
    public function withCommands(array $commands = [])
    {
        // if (empty($commands)) {
            // $commands = [$this->app->path('Console/Commands')];
        // }

        // $this->app->afterResolving(ConsoleKernel::class, function ($kernel) use ($commands) {
            // [$commands, $paths] = collect($commands)->partition(fn ($command) => class_exists($command));
            // [$routes, $paths] = $paths->partition(fn ($path) => is_file($path));

            // $this->app->booted(static function () use ($kernel, $commands, $paths, $routes) {
                // $kernel->addCommands($commands->all());
                // $kernel->addCommandPaths($paths->all());
                // $kernel->addCommandRoutePaths($routes->all());
            // });
        // });

        return $this;
    }

    public function withExceptions(?callable $using = null)
    {
        // $this->app->singleton(
            // \Illuminate\Contracts\Debug\ExceptionHandler::class,
            // \Illuminate\Foundation\Exceptions\Handler::class,
        // );

        // $using ??= fn () => true;

        // $this->app->afterResolving(
            // \Illuminate\Foundation\Exceptions\Handler::class,
            // fn ($handler) => $using(new Exceptions($handle)),
        // );

        return $this;
    }

    public function create()
    {
        return $this->app;
    }
}

