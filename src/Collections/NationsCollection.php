<?php namespace Arcanedev\GeoIP\Collections;

use Illuminate\Support\Collection;

/**
 * Last database update: January 8, 2015
 */
class NationsCollection extends Collection
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var array */
    protected $items = [];

    const DATA_PATH = '/../data/nations.php';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Init Nations collection
     *
     * @return NationsCollection
     */
    public static function init()
    {
        $nations = array_map(function ($item) {
            return self::prepareNation($item);
        }, self::getData());

        return new self($nations);
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
     * Prepare nation
     *
     * @param array $nationItem
     *
     * @return array
     */
    private static function prepareNation($nationItem)
    {
        list($ip, $code) = $nationItem;

        return [
            'ip'   => $ip,
            'code' => $code,
        ];
    }
}
