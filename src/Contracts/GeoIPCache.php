<?php namespace Arcanedev\GeoIP\Contracts;

use Arcanedev\GeoIP\Location;

/**
 * Interface  GeoIPCache
 *
 * @package   Arcanedev\GeoIP\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface GeoIPCache
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get an item from the cache.
     *
     * @param  string  $key
     *
     * @return \Arcanedev\GeoIP\Location|null
     */
    public function get($key);

    /**
     * Store an item in cache.
     *
     * @param  string  $key
     * @param  array   $location
     */
    public function set($key, array $location);

    /**
     * Flush cache for tags.
     */
    public function flush();
}
