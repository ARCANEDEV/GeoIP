<?php namespace Arcanedev\GeoIP\Contracts;

/**
 * Interface  DriverFactory
 *
 * @package   Arcanedev\GeoIP\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface DriverFactory
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     *
     * @return \Arcanedev\GeoIP\Contracts\GeoIPDriver
     */
    public function driver($driver = null);
}
