<?php namespace Arcanedev\GeoIP\Laravel\Models;

use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @property string  ip
 * @property string  code
 * @property Country country
 */
class Nation extends BaseModel
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $tableKey   = 'nations';

    protected $primaryKey = 'ip';

    /* ------------------------------------------------------------------------------------------------
     |  Relationships
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Country Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('Arcanedev\\GeoIP\\Laravel\\Models\\Country', 'code', 'code');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Scopes
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * IP Address condition scope
     *
     * @param QueryBuilder $query
     * @param string       $longIp
     *
     * @return mixed
     */
    public function scopeIp($query, $longIp)
    {
        return $query->where('ip', '<', $longIp);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Nation by IP
     *
     * @param string $longIp
     *
     * @return Nation|null
     */
    public static function getByIp($longIp)
    {
        return self::ip($longIp)->orderBy('ip', 'desc')->first();
    }
}
