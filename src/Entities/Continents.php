<?php namespace Arcanedev\GeoIP\Entities;

use Arcanedev\Support\Collection;

/**
 * Class     Continents
 *
 * @package  Arcanedev\GeoIP\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Continents extends Collection
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make the continents collection.
     *
     * @return self
     */
    public static function load()
    {
        return static::make(
            config('geoip.continents')
        );
    }
}
