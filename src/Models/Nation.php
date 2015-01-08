<?php namespace Arcanedev\GeoIP\Models;

use Arcanedev\GeoIP\GeoIP;

/**
 * @property string  ip
 * @property string  code
 * @property Country country
 */
class Nation extends Base
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $tableKey   = 'nations';

    protected $primaryKey = 'ip';

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
    public function country()
    {
        return $this->belongsTo('Arcanedev\\GeoIP\\Models\\Country', 'code', 'code');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Scopes
     | ------------------------------------------------------------------------------------------------
     */
    public function scopeIp($query, $ip)
    {
        $ip = GeoIP::toLong($ip);

        return $query->where('ip', '<', $ip);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Nation by IP
     *
     * @param string $ip
     *
     * @return Nation|null
     */
    public static function getByIp($ip)
    {
        return self::ip($ip)->orderBy('ip', 'desc')->first();
    }
}
