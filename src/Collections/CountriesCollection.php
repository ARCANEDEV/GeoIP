<?php namespace Arcanedev\GeoIP\Collections;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;

class CountriesCollection extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $items = [];

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public static function init()
    {
        $items = Config::get('geo-ip::countries');

        $countries = array_map(function ($item) {
            list($code, $iso_code_2, $iso_code_3, $iso_country, $country, $lat, $lon) = $item;

            return [
                'code'        => $code,
                'iso_code_2'  => $iso_code_2,
                'iso_code_3'  => $iso_code_3,
                'iso_country' => $iso_country,
                'country'     => $country,
                'lat'         => $lat,
                'lon'         => $lon,
            ];
        }, $items);

        return new self($countries);
    }
}
