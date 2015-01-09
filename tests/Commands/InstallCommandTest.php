<?php namespace Arcanedev\GeoIP\Tests\Commands;

use Arcanedev\GeoIP\Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InstallCommandTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @test
     */
    public function testCanInstallPackage()
    {
        $this->app['artisan']->call('geo-ip:install');

        $schema = Schema::connection('testbench');

        $this->assertTrue($schema->hasTable('geo_nations'));
        $this->assertTrue($schema->hasTable('geo_countries'));

        $this->assertEquals(62601, DB::table('geo_nations')->count());
        $this->assertEquals(246, DB::table('geo_countries')->count());
    }
}
