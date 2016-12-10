<?php namespace Arcanedev\GeoIP\Tests\Drivers;

use Arcanedev\GeoIP\Tests\TestCase;

/**
 * Class     FreeGeoIpDriverTest
 *
 * @package  Arcanedev\GeoIP\Tests\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FreeGeoIpDriverTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\GeoIP\Drivers\FreeGeoIpDriver */
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
        $this->driver = $manager->driver('freegeoip');
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
        $expectations = [
            \Arcanedev\GeoIP\Contracts\GeoIPDriver::class,
            \Arcanedev\GeoIP\Drivers\FreeGeoIpDriver::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->driver);
        }
    }

    /** @test */
    public function it_can_locate()
    {
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
}
