<?php namespace Arcanedev\GeoIP\Entities;

use Arcanedev\Support\Collection;

/**
 * Class     Currencies
 *
 * @package  Arcanedev\GeoIP\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Currencies extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make the currencies collection.
     *
     * @param  array  $items
     *
     * @return self
     */
    public static function make($items = [])
    {
        return new static(
            config('geoip.currencies.data', $items)
        );
    }
}
