<?php namespace Arcanedev\GeoIP\Contracts;

/**
 * Interface  GeoIPDriver
 *
 * @package   Arcanedev\GeoIP\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface GeoIPDriver
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Locate the ip address.
     *
     * @param  string  $ipAddress
     *
     * @return \Arcanedev\GeoIP\Location
     */
    public function locate($ipAddress);

    /**
     * Update function for service.
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function update();
}
