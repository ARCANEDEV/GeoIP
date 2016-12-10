<?php namespace Arcanedev\GeoIP\Tests;

/**
 * Class     GeoIPTest
 *
 * @package  Arcanedev\GeoIP\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIPTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var  \Arcanedev\GeoIP\GeoIP */
    private $geoip;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
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

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanedev\GeoIP\Contracts\GeoIP::class,
            \Arcanedev\GeoIP\GeoIP::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->geoip);
        }
    }

    /** @test */
    public function it_can_get_driver()
    {
        $this->assertInstanceOf(\Arcanedev\GeoIP\Contracts\GeoIPDriver::class, $this->geoip->driver());
    }

    /** @test */
    public function it_can_get_cache()
    {
        $this->assertInstanceOf(\Arcanedev\GeoIP\Contracts\GeoIPCache::class, $this->geoip->cache());
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
            $this->assertSame($expected, $this->geoip->getCurrency($iso));
        }
    }

    /** @test */
    public function it_can_get_location()
    {
        $ip = '128.101.101.101';

        $location = $this->geoip->location($ip);

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
            'currency'    => 'USD',
            'default'     => false,
        ];

        $this->assertSame($expected, $location->attributes());
        $this->assertSame($expected, $location->toArray());

        $this->assertFalse($location->default);
        $this->assertSame($expected['city'].', '.$expected['state_code'], $location->display_name);
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

        $this->assertSame($default, $location->attributes());
        $this->assertSame($default, $location->toArray());

        $this->assertFalse($location->default);
        $this->assertSame($default['city'].', '.$default['state_code'], $location->display_name);
    }
}
