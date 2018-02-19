<?php namespace Arcanedev\GeoIP\Tests\Drivers;

use Arcanedev\GeoIP\Tests\TestCase;

/**
 * Class     IpApiDriverTest
 *
 * @package  Arcanedev\GeoIP\Tests\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class IpApiDriverTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoIP\Drivers\IpApiDriver */
    protected $driver;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        /** @var  \Arcanedev\GeoIP\Contracts\DriverFactory  $manager */
        $manager      = $this->app->make(\Arcanedev\GeoIP\Contracts\DriverFactory::class);
        $this->driver = $manager->driver('ip-api');
    }

    public function tearDown()
    {
        unset($this->driver);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\GeoIP\Contracts\GeoIPDriver::class,
            \Arcanedev\GeoIP\Drivers\IpApiDriver::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->driver);
        }
    }

    /** @test */
    public function it_can_locate()
    {
        $location = $this->driver->locate('128.101.101.101');

        static::assertInstanceOf(\Arcanedev\GeoIP\Location::class, $location);

        $expected = [
            'ip'          => '128.101.101.101',
            'iso_code'    => 'US',
            'country'     => 'United States',
            'city'        => 'Saint Paul',
            'state'       => 'Minnesota',
            'state_code'  => 'MN',
            'postal_code' => '55102',
            'latitude'    => 44.9278,
            'longitude'   => -93.1162,
            'timezone'    => 'America/Chicago',
            'continent'   => 'NA',
        ];

        static::assertSame($expected, $location->attributes());
        static::assertSame($expected, $location->toArray());

        static::assertFalse($location->default);
        static::assertSame($expected['city'].', '.$expected['state_code'], $location->display_name);
    }
}
