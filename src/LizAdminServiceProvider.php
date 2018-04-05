<?php

namespace Lizyu\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        $this->registerValdateRule();
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
        ], 'admin.assets');
    }
    
    protected function publishConfig()
    {
        $this->publishes([
            __DIR__  . '/../config/auth.php' => $this->app->configPath() . '/auth.php',
            __DIR__  . '/../database/create_users_table.php' => $this->app->databasePath() . '/migrations/'.date('Y_m_d_His', time()).'_create_users_table.php',
            __DIR__  . '/../database/seeds/UsersTableSeeder.php' => $this->app->databasePath() . '/seeds//UsersTableSeeder.php',
        ], 'admin.config');
    }
    
    protected function requireRoute()
    {
        $this->loadRoutesFrom( __DIR__ . '/route.php' );
    }
    
    /**
     * @description:注册验证规则
     * @author wuyanwen(2018年4月4日)
     */
    protected function registerValdateRule()
    {
        Validator::extend('behavior', function($attribute, $value, $parameters){
            return preg_match('/^[a-z]{4,20}\@[a-z]{4,20}$/', $value);
        }); 
    }
    
    protected function requireView()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'lizadmin');
    }
}
