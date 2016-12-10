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
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make the continents collection.
     *
     * @param  array  $items
     *
     * @return self
     */
    public static function make($items = [])
    {
        return new static(
            config('geoip.continents', $items)
        );
    }
}
