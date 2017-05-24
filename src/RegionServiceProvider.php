<?php

namespace Wjh\Region;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Wjh\Region\Region;

class RegionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //路由文件
        app('router')->group(['namespace' => __NAMESPACE__], function ($router) {
            $router->get('/region/index', 'RegionController@index');
            $router->get('/region/city', 'RegionController@getCity');
            $router->get('/region/county', 'RegionController@getCounty');
        });

        //视图文件
        $viewPath = realpath(__DIR__ . '/../resource/views/index.blade.php');
        $this->loadViewsFrom($viewPath, 'Region');
        $this->publishes([
            $viewPath => resource_path('views/vendor/region/index.blade.php'),
        ], 'view');
        //资源文件
        $this->publishes([
            realpath(__DIR__ . '/../resource/jquery.min.js') => public_path('js/jquery.min.js')
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('region', function() {
            return new Region();
        });
        //配置文件
        $this->publishes([
            realpath(__DIR__ . '/../config/region.php') => config_path('region.php')
        ], 'config');
    }
}
