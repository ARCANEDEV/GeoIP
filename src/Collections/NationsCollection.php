<?php namespace Arcanedev\GeoIP\Collections;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Collection;

class NationsCollection extends Collection
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
        $items = Config::get('geo-ip::nations');

        $nations = array_map(function ($item) {
            list($ip, $code) = $item;

            return [
                'ip'   => $ip,
                'code' => $code,
            ];
        }, $items);

        return new self($nations);
    }
}
