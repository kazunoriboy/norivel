<?php

namespace Illuminate\Foundation\Http;

use Illuminate\Contracts\Http\Kernel as KernelContract;
use Illuminate\Support\Carbon;
use Throwable;

class Kernel implements KernelContract
{
    protected $app;

    protected $router;

    protected $middlewareGroups = [];

    protected $routeMiddleware = [];

    protected $middlewareAliases = [];

    protected $middlewarePriority = [
        \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
        \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
        \Illuminate\Contracts\Session\Middleware\AuthenticateSessions::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ]   

    public function __construct(Application $app, Router $router)
    {
        $this->app = $app;
        $this->router = $router;

        $this->syncMiddlewareToRouter();
    }

    public function handle($request)
    {
        $this->requestStartedAt = Carbon::now();

        try {
            $request->enableHttpMethodParameterOverride();

            $response = $this->sendRequestThroughRouter($request);
        } catch (Throwable $e) {
            $this->reportException($e);

            $response = $this->renderException($request, $e);
        }

        $this->app['events']->dispatch(
            new RequestHandled($request, $response)
        );

        return $response;
    }

    public function bootstrap()
    {
        if (! $this->app->hasBeenBootstrapped()) {
            $this->app->bootstrapWith($this->bootstrappers());
        }
    }

    public function terminate($request, $response)
    {

    }

    public function getApplication()
    {

    }

    protected function syncMiddlewareToRouter()
    {
        $this->router->middlewarePriority = $this->middlewarePriority;

        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->router->middlewareGroup($key, $middleware);
        }

        foreach (array_merge($this->routeMiddleware, $this->middlewareAliases) as $key => $middleware) {
            $this->router->aliasMiddleware($key, $middleware);
        }
    }
}