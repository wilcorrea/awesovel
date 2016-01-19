<?php

namespace Awesovel\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AwesovelServiceProvider extends ServiceProvider
{
    use \Illuminate\Console\AppNamespaceDetectorTrait;

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    public static $NAMESPACE;

    /**
     * @var string
     */
    public static $LANGUAGE;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $this->initNamespace();

        self::$LANGUAGE = config('awesovel')['language'];
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $this->initNamespace();

        $router->group(['namespace' => self::$NAMESPACE], function ($router) {
            require base_path('vendor/awesovel/routes.php');
        });
    }

    private function initNamespace()
    {
        self::$NAMESPACE = '\\' . substr($this->getAppNamespace(), 0, -1);
    }

}