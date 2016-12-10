<?php namespace Arcanedev\GeoIP\Tests;

/**
 * Class     GeoIPServiceProviderTest
 *
 * @package  Arcanedev\GeoIP\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIPServiceProviderTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\GeoIP\GeoIPServiceProvider */
    private $provider;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(\Arcanedev\GeoIP\GeoIPServiceProvider::class);
    }

    public function tearDown()
    {
        unset($this->provider);

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
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\ServiceProvider::class,
            \Arcanedev\Support\PackageServiceProvider::class,
            \Arcanedev\GeoIP\GeoIPServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->provider);
        }
    }

    /** @test */
    public function it_can_provides()
    {
        $expected = [
            'geoip',
            \Arcanedev\GeoIP\Contracts\GeoIP::class,
            \Arcanedev\GeoIP\Contracts\DriverFactory::class,
            \Arcanedev\GeoIP\Contracts\GeoIPDriver::class,
            \Arcanedev\GeoIP\Contracts\GeoIPCache::class,
            \Arcanedev\GeoIP\Contracts\DriverFactory::class,
        ];

        $this->assertSame($expected, $this->provider->provides());
    }
}
