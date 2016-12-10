<?php namespace Arcanedev\GeoIP;

use Arcanedev\GeoIP\Contracts\DriverFactory;
use Arcanedev\Support\Manager;

/**
 * Class     DriverManager
 *
 * @package  Arcanedev\GeoIP
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DriverManager extends Manager implements DriverFactory
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->getConfig('default');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Build the 'ip-api' driver.
     *
     * @return Drivers\IpApiDriver
     */
    protected function createIpApiDriver()
    {
        return $this->buildDriver('ip-api');
    }

    /**
     * Get the 'maxmind-database' driver.
     *
     * @return mixed
     */
    protected function createMaxmindDatabaseDriver()
    {
        return $this->buildDriver('maxmind-database');
    }

    /**
     * Get the 'maxmind-api' driver.
     *
     * @return Drivers\MaxmindApiDriver
     */
    protected function createMaxmindApiDriver()
    {
        return $this->buildDriver('maxmind-api');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Build the driver.
     *
     * @param  string  $key
     *
     * @return mixed
     */
    private function buildDriver($key)
    {
        $class = $this->getDriverClass($key);

        return new $class($this->getDriverOptions($key));
    }

    /**
     * Get the driver class.
     *
     * @param  string  $key
     *
     * @return string
     */
    private function getDriverClass($key)
    {
        return $this->getConfig("supported.$key.driver");
    }

    /**
     * Get the driver options.
     *
     * @param  string  $key
     *
     * @return array
     */
    private function getDriverOptions($key)
    {
        return $this->getConfig("supported.$key.options", []);
    }

    /**
     * Get the config.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    public function getConfig($key, $default = null)
    {
        return $this->config()->get("geoip.$key", $default);
    }

    /**
     * Get the getOption instance.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    private function config()
    {
        return $this->app['config'];
    }
}
