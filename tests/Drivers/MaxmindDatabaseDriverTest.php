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
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(
            \Arcanedev\GeoIP\Drivers\MaxmindDatabaseDriver::class,
            $this->makeDriver()
        );
    }

    /** @test */
    public function it_can_locate()
    {
        $this->switchDatabasePath();

        $location = $this->makeDriver()->locate('128.101.101.101');

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
            'continent' => 'NA',
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
        $this->makeDriver()->locate('127.0.0.1');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Make the driver.
     *
     * @return \Arcanedev\GeoIP\Contracts\GeoIPDriver
     */
    private function makeDriver()
    {
        $manager = $this->app->make(\Arcanedev\GeoIP\Contracts\DriverFactory::class);

        return $manager->driver('maxmind-database');
    }

    /**
     * Switch the database for tests.
     */
    private function switchDatabasePath()
    {
        $this->config()->set(
            'geoip.supported.maxmind-database.options.database-path',
            realpath(__DIR__ . '/../fixture/data/geoip.mmdb')
        );
    }
}
