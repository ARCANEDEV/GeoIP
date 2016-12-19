<?php namespace Arcanedev\GeoIP;

use Arcanedev\Support\PackageServiceProvider;
use Illuminate\Support\Arr;

/**
 * Class     GeoIPServiceProvider
 *
 * @package  Arcanedev\GeoIP
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIPServiceProvider extends PackageServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'geoip';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer   = true;

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the base path of the package.
     *
     * @return string
     */
    public function getBasePath()
    {
        return dirname(__DIR__);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerConfig();

        $this->registerGeoIpManager();
        $this->registerGeoIpCache();
        $this->registerGeoIp();
        $this->registerConsoleServiceProvider(Providers\CommandServiceProvider::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        parent::boot();

        $this->publishConfig();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'geoip',
            Contracts\GeoIP::class,
            Contracts\DriverFactory::class,
            Contracts\GeoIPDriver::class,
            Contracts\GeoIPCache::class,
            Contracts\DriverFactory::class,
        ];
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Register the GeoIP manager.
     */
    private function registerGeoIpManager()
    {
        $this->singleton(Contracts\DriverFactory::class, DriverManager::class);
        $this->singleton(Contracts\GeoIPDriver::class, function ($app) {
            return $app[Contracts\DriverFactory::class]->driver();
        });
    }

    /**
     * Register the GeoIP Cache store.
     */
    private function registerGeoIpCache()
    {
        $this->singleton(Contracts\GeoIPCache::class, function ($app) {
            /** @var \Illuminate\Contracts\Config\Repository $config */
            $config = $app['config'];

            return new Cache(
                $this->app['cache.store'],
                $config->get('geoip.cache.tags', []),
                $config->get('geoip.cache.expires', 30)
            );
        });
    }

    /**
     * Register the GeoIP.
     */
    private function registerGeoIp()
    {
        $this->singleton(Contracts\GeoIP::class, function ($app) {
            /** @var \Illuminate\Contracts\Config\Repository $config */
            $config = $app['config'];

            return new GeoIP(
                $app[Contracts\GeoIPDriver::class],
                $app[Contracts\GeoIPCache::class],
                Arr::only($config->get('geoip', []), ['cache', 'location', 'currencies'])
            );
        });

        $this->singleton('arcanedev.geoip', Contracts\GeoIP::class);
    }
}
