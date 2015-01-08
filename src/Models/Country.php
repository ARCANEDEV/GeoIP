<?php namespace Arcanedev\GeoIP\Models;

/**
 * @property string code
 * @property string iso_code_2
 * @property string iso_code_3
 * @property string iso_country
 * @property string country
 * @property float  lat
 * @property float  lon
 * @property Nation nation
 */
class Country extends Base
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $table      = 'geo_countries';

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    public function nations()
    {
        return $this->hasMany('Arcanedev\\GeoIP\\Models\\Nation', 'code', 'code');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Function
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Country By IP
     *
     * @param string $ip
     *
     * @return Country
     */
    public static function getByIp($ip)
    {
        $country = null;
        $nation  = Nation::getByIp($ip);

        if ($nation) {
            $country = $nation->country;
        }

        return $country;
    }
}
