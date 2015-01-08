<?php namespace Arcanedev\GeoIP;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
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
     */
    private function registerServices()
    {
        $this->app->singleton('arcanedev.geo-ip', function() {
            return new GeoIP;
        });
    }

    private function registerCommands()
    {
        $this->app['geo-ip:install'] = $this->app->share(function($app)
        {
            return new Commands\InstallCommand($app);
        });

        $this->commands('geo-ip:install');
    }
}
