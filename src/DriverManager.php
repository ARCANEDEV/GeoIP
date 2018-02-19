<?php namespace Arcanedev\GeoIP;

use Arcanedev\GeoIP\Contracts\DriverFactory;
use Illuminate\Support\Manager;

/**
 * Class     DriverManager
 *
 * @package  Arcanedev\GeoIP
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DriverManager extends Manager implements DriverFactory
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config()->get("geoip.default");
    }

    /**
     * Get the config instance.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    private function config()
    {
        return $this->app['config'];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Build the 'ip-api' driver.
     *
     * @return \Arcanedev\GeoIP\Drivers\AbstractDriver
     */
    protected function createIpApiDriver()
    {
        return $this->buildDriver('ip-api');
    }

    /**
     * Build the 'freegeoip' driver.
     *
     * @return \Arcanedev\GeoIP\Drivers\AbstractDriver
     */
    protected function createFreegeoipDriver()
    {
        return $this->buildDriver('freegeoip');
    }

    /**
     * Get the 'maxmind-database' driver.
     *
     * @return \Arcanedev\GeoIP\Drivers\AbstractDriver
     */
    protected function createMaxmindDatabaseDriver()
    {
        return $this->buildDriver('maxmind-database');
    }

    /**
     * Get the 'maxmind-api' driver.
     *
     * @return \Arcanedev\GeoIP\Drivers\AbstractDriver
     */
    protected function createMaxmindApiDriver()
    {
        return $this->buildDriver('maxmind-api');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Build the driver.
     *
     * @param  string  $name
     *
     * @return \Arcanedev\GeoIP\Drivers\AbstractDriver
     */
    private function buildDriver($name)
    {
        $class = $this->config()->get("geoip.drivers.$name.driver");

        return new $class(
            $this->config()->get("geoip.drivers.$name.options", [])
        );
    }
}
