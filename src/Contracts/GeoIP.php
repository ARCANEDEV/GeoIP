<?php namespace Arcanedev\GeoIP\Contracts;

/**
 * Interface  GeoIP
 *
 * @package   Arcanedev\GeoIP\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface GeoIP
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the GeoIP driver instance.
     *
     * @return \Arcanedev\GeoIP\Contracts\GeoIPDriver
     */
    public function driver();

    /**
     * Get cache instance.
     *
     * @return \Arcanedev\GeoIP\Contracts\GeoIPCache
     */
    public function cache();

    /**
     * Set the default location.
     *
     * @param  array  $location
     *
     * @return self
     */
    public function setDefaultLocation(array $location);

    /**
     * Get the currency code from ISO.
     *
     * @param  string  $iso
     *
     * @return string
     */
    public function getCurrency($iso);

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the location from the provided IP.
     *
     * @param  string  $ipAddress
     *
     * @return \Arcanedev\GeoIP\Location
     */
    public function location($ipAddress = null);
}
