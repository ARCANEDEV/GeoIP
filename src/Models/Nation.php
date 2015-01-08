<?php namespace Arcanedev\GeoIP\Models;

class Nation extends Base
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $table      = 'geo_nations';

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
}
