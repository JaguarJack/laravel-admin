<?php

namespace Lizyu\Admin;

use Illuminate\Support\ServiceProvider;

class LizAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->requireView();
    }
    
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->requireRoute();
        $this->publishAssets();
        $this->publishConfig();
    }

    protected function publishAssets()
    {
        $this->publishes([ 
            __DIR__  . '/../resources/assets/' => $this->app->publicPath() . '/assets/',
        ], 'lizyu.assets');
    }
    
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__  . '/../config/auth.php' => $this->app->configPath() . '/auth.php',
            __DIR__  . '/../database/create_users_table.php' => $this->app->databasePath() . '/migrations/'.date('Y_m_d_His', time()).'_create_users_table.php',
        ], 'config');
    }
    
    protected function requireRoute()
    {
        $this->loadRoutesFrom( __DIR__ . '/route.php' );
    }
    
    public function requireView()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'lizadmin');
    }
}
