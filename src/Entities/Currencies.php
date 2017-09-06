<?php namespace Arcanedev\GeoIP\Entities;

use Illuminate\Support\Collection;

/**
 * Class     Currencies
 *
 * @package  Arcanedev\GeoIP\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Currencies extends Collection
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Make the currencies collection.
     *
     * @return self
     */
    public static function load()
    {
        return static::make(
            config('geoip.currencies.data')
        );
    }
}
