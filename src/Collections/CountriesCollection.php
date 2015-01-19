<?php namespace Arcanedev\GeoIP\Collections;

use Illuminate\Support\Collection;

/**
 * Last database update: January 8, 2015
 */
class CountriesCollection extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var array */
    protected $items = [];

    const DATA_PATH = '/../data/countries.php';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Init Countries collection
     *
     * @return CountriesCollection
     */
    public static function init()
    {
        $countries = array_map(function ($item) {
            return self::prepareCountry($item);
        }, self::getData());

        return new self($countries);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Data
     *
     * @return array
     */
    private static function getData()
    {
        $path = realpath(__DIR__ . self::DATA_PATH);

        return is_file($path) ? include $path : [];
    }

    /**
     * Prepare country
     *
     * @param array $countryItem
     *
     * @return array
     */
    private static function prepareCountry($countryItem)
    {
        list($code, $iso_code_2, $iso_code_3, $iso_country, $country, $lat, $lon) = $countryItem;

        return [
            'code'        => $code,
            'iso_code_2'  => $iso_code_2,
            'iso_code_3'  => $iso_code_3,
            'iso_country' => $iso_country,
            'country'     => $country,
            'lat'         => $lat,
            'lon'         => $lon,
        ];
    }
}
