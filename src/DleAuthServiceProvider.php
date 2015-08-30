<?php namespace Maxic\DleAuth;

use Auth;
use Illuminate\Support\ServiceProvider;

class DleAuthServiceProvider extends ServiceProvider {

    public function boot() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->publishes([
            __DIR__.'/../config/dleauth.php' => config_path('dleauth.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../config/dleauth.php', 'dleauth'
        );

        Auth::extend('dleauth', function()
        {
            $connection = $this->app['db']->connection();
            $table = $this->app['config']['dleauth.table'];

            return new DleAuthUserProvider($connection, $table);
        });

        \Event::subscribe('\Maxic\DleAuth\Handlers\Events\UserAuth');
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}