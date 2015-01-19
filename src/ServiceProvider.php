<?php namespace Arcanedev\GeoIP;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('arcanedev/geo-ip', 'geo-ip', __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();

        $this->registerCommands();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'arcanedev.geo-ip'
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     *  Register Services
     *
     * @return void
     */
    private function registerServices()
    {
        $this->app->singleton('arcanedev.geo-ip', function() {
            return new GeoIP;
        });
    }

    /**
     * Register Commands
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->bindShared('geo-ip:install', function($app) {
            return new Commands\InstallCommand($app);
        });

        $this->app->bindShared('geo-ip:dump', function($app) {
            return new Commands\DumpSqlCommand($app);
        });

        $this->commands('geo-ip:install');
        $this->commands('geo-ip:dump');
    }
}
