<?php namespace Arcanedev\GeoIP\Tests;

/**
 * Class     DriverManagerTest
 *
 * @package  Arcanedev\GeoIP\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DriverManagerTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoIp\DriverManager */
    private $manager;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->manager = $this->app->make(\Arcanedev\GeoIP\Contracts\DriverFactory::class);
    }

    public function tearDown()
    {
        unset($this->manager);

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
            \Illuminate\Support\Manager::class,
            \Arcanedev\GeoIP\Contracts\DriverFactory::class,
            \Arcanedev\GeoIP\DriverManager::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->manager);
        }
    }

    /** @test */
    public function it_can_get_default_driver()
    {
        static::assertInstanceOf(
            \Arcanedev\GeoIP\Drivers\FreeGeoIpDriver::class,
            $this->manager->driver()
        );
    }

    /** @test */
    public function it_can_get_driver_by_name()
    {
        $drivers = [
            'freegeoip'        => \Arcanedev\GeoIP\Drivers\FreeGeoIpDriver::class,
            'ip-api'           => \Arcanedev\GeoIP\Drivers\IpApiDriver::class,
            'maxmind-database' => \Arcanedev\GeoIP\Drivers\MaxmindDatabaseDriver::class,
            'maxmind-api'      => \Arcanedev\GeoIP\Drivers\MaxmindApiDriver::class,
        ];

        foreach ($drivers as $name => $driver) {
            static::assertInstanceOf($driver, $this->manager->driver($name));
        }
    }
}
