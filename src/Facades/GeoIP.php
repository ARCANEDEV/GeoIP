<?php namespace Arcanedev\GeoIP\Facades;

use Arcanedev\GeoIP\Contracts\GeoIP as GeoIPContract;
use Illuminate\Support\Facades\Facade;

/**
 * Class     GeoIP
 *
 * @package  Arcanedev\GeoIP\Facades
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIP extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return GeoIPContract::class; }
}
