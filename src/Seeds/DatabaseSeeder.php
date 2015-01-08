<?php namespace Arcanedev\GeoIP\Seeds;

use Illuminate\Database\Seeder         as Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;

class DatabaseSeeder extends Seeder
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */

    const BASE_NAMESPACE = 'Arcanedev\\GeoIP\\Seeds\\';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function run()
    {
        Eloquent::unguard();

        $this->runSeeder('NationsTableSeeder');
        $this->runSeeder('CountriesTableSeeder');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function runSeeder($name)
    {
        $this->call(self::BASE_NAMESPACE . $name);
    }
}
