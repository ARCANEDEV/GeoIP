<?php namespace Arcanedev\GeoIP\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * @property string             code
 * @property string             iso_code_2
 * @property string             iso_code_3
 * @property string             iso_country
 * @property string             country
 * @property float              lat
 * @property float              lon
 * @property EloquentCollection nations
 */
class Country extends BaseModel
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $tableKey = 'countries';


    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Nations Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
     * @param string $longIp
     *
     * @return Country
     */
    public static function getByIp($longIp)
    {
        $nation  = Nation::getByIp($longIp);

        return $nation ? $nation->country : null;
    }
}
