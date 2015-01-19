<?php namespace Arcanedev\GeoIP\Tests\Commands;

use Arcanedev\GeoIP\Tests\LaravelTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InstallCommandTest extends LaravelTestCase
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
    public function testCanInstallAndUninstallPackage()
    {
        $this->app['artisan']->call('geo-ip:install');

        $schema = Schema::connection('testbench');

        $this->assertTrue($schema->hasTable('migrations'));
        $this->assertTrue($schema->hasTable('geo_nations'));
        $this->assertTrue($schema->hasTable('geo_countries'));

        $this->assertEquals(2, DB::table('migrations')->count());
        $this->assertEquals(62601, DB::table('geo_nations')->count());
        $this->assertEquals(246, DB::table('geo_countries')->count());

        $this->app['artisan']->call('migrate:rollback', [
            '--database' => 'testbench'
        ]);

        $this->assertTrue($schema->hasTable('migrations'));
        $this->assertEquals(0, DB::table('migrations')->count());
    }
}
