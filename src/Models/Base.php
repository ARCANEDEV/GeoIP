<?php namespace Arcanedev\GeoIP\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Base extends Model
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $connection = 'sqlite';

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct($attributes = [])
    {
        $connection = 'sqlite';

        parent::__construct($attributes = []);
    }
}
