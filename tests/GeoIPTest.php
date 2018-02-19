<?php namespace Arcanedev\GeoIP\Tests;

/**
 * Class     GeoIPTest
 *
 * @package  Arcanedev\GeoIP\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIPTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoIP\GeoIP */
    private $geoip;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->geoip = $this->app->make(\Arcanedev\GeoIP\Contracts\GeoIP::class);
    }

    public function tearDown()
    {
        unset($this->geoip);

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
            \Arcanedev\GeoIP\Contracts\GeoIP::class,
            \Arcanedev\GeoIP\GeoIP::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->geoip);
        }
    }

    /** @test */
    public function it_can_get_driver()
    {
        static::assertInstanceOf(\Arcanedev\GeoIP\Contracts\GeoIPDriver::class, $this->geoip->driver());
    }

    /** @test */
    public function it_can_get_cache()
    {
        static::assertInstanceOf(\Arcanedev\GeoIP\Contracts\GeoIPCache::class, $this->geoip->cache());
    }

    /** @test */
    public function it_can_get_currency_from_config()
    {
        $currencies = [
            'FR' => 'EUR',
            'MA' => 'MAD',
            'US' => 'USD',
        ];

        foreach ($currencies as $iso => $expected) {
            static::assertSame($expected, $this->geoip->getCurrency($iso));
        }
    }

    /** @test */
    public function it_can_get_location()
    {
        $location = $this->geoip->location($ip = '128.101.101.101');

        static::assertInstanceOf(\Arcanedev\GeoIP\Location::class, $location);

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
            'currency'    => 'USD',
            'default'     => false,
        ];

        static::assertSame($expected, $location->attributes());
        static::assertSame($expected, $location->toArray());

        static::assertFalse($location->default);
        static::assertSame($expected['city'].', '.$expected['state_code'], $location->display_name);
    }

    /** @test */
    public function it_can_get_default_location_if_it_fails()
    {
        $this->geoip->setDefaultLocation($default  = [
            'ip'          => '127.0.0.1',
            'iso_code'    => 'ZZ',
            'country'     => 'Zootopia',
            'city'        => 'Tundratown city',
            'state'       => 'Tundratown',
            'state_code'  => 'TU',
            'postal_code' => '112233',
            'latitude'    => 12,
            'longitude'   => 12,
            'timezone'    => 'UTC',
            'continent'   => 'Disney',
            'currency'    => 'ZZZ',
        ]);

        $location = $this->geoip->location('0.0.0');

        static::assertSame($default, $location->attributes());
        static::assertSame($default, $location->toArray());

        static::assertFalse($location->default);
        static::assertSame($default['city'].', '.$default['state_code'], $location->display_name);
    }
}
