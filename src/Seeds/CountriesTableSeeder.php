<?php namespace Arcanedev\GeoIP\Seeds;

use Illuminate\Database\Seeder;
use Arcanedev\GeoIP\Collections\CountriesCollection;
use Arcanedev\GeoIP\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $countries;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        $this->countries = CountriesCollection::init();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function run()
    {
        foreach ($this->countries->chunk(50)->toArray() as $countries) {
            Country::insert($countries);
        }
    }
}
