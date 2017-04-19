<?php
/**
 * Created by PhpStorm.
 * User: gennadiy
 * Date: 19.04.2017
 * Time: 22:12
 */


namespace GennadiyBilyk\Roles;

use Illuminate\Support\ServiceProvider;

class RolesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__.'/src/Http/Sections' => app_path('/Http/Sections')
        ], 'sections');

        $this->publishes([
            __DIR__.'/src/Http/Middleware' => app_path('/Http/Middleware')
        ], 'middleware');


        $this->publishes([
            __DIR__.'/src/Models/Permission' => app_path('/Models/Permission')
        ], 'models');

        //
        $this->publishes([
            __DIR__.'/src/database/migrations/' => base_path('/database/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/src/database/seeds/' => base_path('/database/seeds'),
        ], 'seeds');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}