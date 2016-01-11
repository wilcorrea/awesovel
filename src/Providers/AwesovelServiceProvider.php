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
    protected $_namespace = '';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
        
        if (!defined('APP_NAMESPACE')) {
          define('APP_NAMESPACE', substr($this->getAppNamespace(), 0, -1));
        }
        
        $this->_namespace = APP_NAMESPACE . '\Src\Controllers';
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->_namespace], function ($router) {
            require base_path('vendor/awesovel/routes.php');
        });
    }

}