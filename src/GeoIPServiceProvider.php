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
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
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
    protected $defer = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register()
    {
        parent::register();

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
            Contracts\GeoIP::class,
            Contracts\DriverFactory::class,
            Contracts\GeoIPDriver::class,
            Contracts\GeoIPCache::class,
            Contracts\DriverFactory::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the GeoIP manager.
     */
    private function registerGeoIpManager()
    {
        $this->singleton(Contracts\DriverFactory::class, function ($app) {
            return new DriverManager($app);
        });

        $this->singleton(Contracts\GeoIPDriver::class, function ($app) {
            /** @var  \Arcanedev\GeoIP\Contracts\DriverFactory  $manager */
            $manager = $app[Contracts\DriverFactory::class];

            return $manager->driver();
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
                $app['cache.store'],
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
    }
}
