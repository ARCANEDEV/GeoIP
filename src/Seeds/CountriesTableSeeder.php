<?php namespace Arcanedev\GeoIP\Seeds;

use Arcanedev\GeoIP\Collections\CountriesCollection;
use Arcanedev\GeoIP\Models\Country;
use Illuminate\Database\Seeder;

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
