<?php namespace Arcanedev\GeoIP\Tests\Drivers;

use Arcanedev\GeoIP\Tests\TestCase;

/**
 * Class     MaxmindDatabaseDriverTest
 *
 * @package  Arcanedev\GeoIP\Tests\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaxmindDatabaseDriverTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties 
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\GeoIP\Drivers\MaxmindDatabaseDriver */
    protected $driver;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions 
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        /** @var  \Arcanedev\GeoIP\Contracts\DriverFactory  $manager */
        $manager      = $this->app->make(\Arcanedev\GeoIP\Contracts\DriverFactory::class);
        $this->driver = $manager->driver('maxmind-database');
    }

    public function tearDown()
    {
        unset($this->driver);

        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions 
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(\Arcanedev\GeoIP\Drivers\MaxmindDatabaseDriver::class, $this->driver);
    }

    /** @test */
    public function it_can_locate()
    {
        $this->switchDatabasePath();

        $location = $this->driver->locate('128.101.101.101');

        $this->assertInstanceOf(\Arcanedev\GeoIP\Location::class, $location);

        $expected = [
            'ip'          => '128.101.101.101',
            'iso_code'    => 'US',
            'country'     => 'United States',
            'city'        => 'Minneapolis',
            'state'       => 'Minnesota',
            'state_code'  => 'MN',
            'postal_code' => '55414',
            'latitude'    => 44.9759,
            'longitude'   => -93.2166,
            'timezone'    => 'America/Chicago',
            'continent'   => 'NA',
        ];

        $this->assertSame($expected, $location->attributes());
        $this->assertSame($expected, $location->toArray());

        $this->assertFalse($location->default);
        $this->assertSame($expected['city'].', '.$expected['state_code'], $location->display_name);
    }

    /**
     * @test
     *
     * @expectedException         \GeoIp2\Exception\AddressNotFoundException
     * @expectedExceptionMessage  The address 127.0.0.1 is not in the database.
     */
    public function it_must_throw_an_address_not_found_exception_on_locate()
    {
        $this->driver->locate('127.0.0.1');
    }

    /** @test */
    public function it_can_update()
    {
        $this->assertTrue($this->driver->update());
        $this->assertNotFalse($path = $this->getDatabasePath());

        unlink($path);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Switch the database for tests.
     */
    private function switchDatabasePath()
    {
        $this->config()->set(
            'geo-ip.supported.maxmind-database.options.database-path',
            realpath(__DIR__ . '/../fixture/data/geoip.mmdb')
        );
    }

    /**
     * Get the database path.
     *
     * @return string
     */
    private function getDatabasePath()
    {
        return realpath(
            $this->config()->get('geo-ip.supported.maxmind-database.options.database-path')
        );
    }
}
