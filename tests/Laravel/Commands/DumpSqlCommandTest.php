<?php namespace Arcanedev\GeoIP\Tests\Laravel\Commands;

use Arcanedev\GeoIP\Tests\LaravelTestCase;

class DumpSqlCommandTest extends LaravelTestCase
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

    public static function tearDownAfterClass()
    {
        $file = realpath(dirname(__FILE__) . '/../database/geo-db.sql');

        if ($file) {
            unlink($file);
        }
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @test
     */
    public function testCanDumpSqlFile()
    {
        $this->app['artisan']->call('geo-ip:dump');

        // Test if can overwrite the file if exists
        $this->app['artisan']->call('geo-ip:dump');
    }
}
