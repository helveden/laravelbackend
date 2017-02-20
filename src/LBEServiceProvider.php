<?php 

namespace Helveden\LBE;

use Illuminate\Support\ServiceProvider;

class LBEServiceProvider extends ServiceProvider {
	
	protected $defer = false;
 
    public function boot() {

        $racine = dirname(__DIR__);

        // Get namespace
        $nameSpace = $this->app->getNamespace();
 
        // Routes
        $this->loadRoutesFrom($racine.'/routes/web.php');

        // $this->app->router->group(['namespace' => $nameSpace . 'Http\Controllers'], function()
        // {
        //     require __DIR__.'/Http/routes.php';
        // });
 
        // Views
        // $this->publishes([
        //     __DIR__.'/../views' => base_path('resources/views'),
        //     __DIR__.'/../views/auth' => base_path('resources/views/auth'),
        //     __DIR__.'/../views/emails' => base_path('resources/views/emails'),
        // ]);
    }
 
    public function register() {
        
    }

}