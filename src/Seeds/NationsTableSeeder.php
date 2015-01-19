<?php namespace Arcanedev\GeoIP\Seeds;

use Arcanedev\GeoIP\Collections\NationsCollection;
use Arcanedev\GeoIP\Models\Nation;
use Illuminate\Database\Seeder;

class NationsTableSeeder extends Seeder
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $nations;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->nations = NationsCollection::init();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function run()
    {
        foreach ($this->nations->chunk(450)->toArray() as $nations) {
            Nation::insert($nations);
        }
    }
}
