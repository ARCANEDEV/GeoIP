<?php namespace Arcanedev\GeoIP\Tests\Laravel\Models;

use Arcanedev\GeoIP\Laravel\Models\Country;
use Arcanedev\GeoIP\Tests\LaravelTestCase;

class CountryTest extends LaravelTestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    const COUNTRY_CLASS = 'Arcanedev\\GeoIP\\Laravel\\Models\\Country';
    /** @var Country */
    private $country;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->setPackageConfig($this->app, 'testing');

        $this->country = new Country;
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->country);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @test
     */
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(self::COUNTRY_CLASS, $this->country);
        $this->assertEquals(0, $this->country->nations()->count());
    }

    /**
     * @test
     */
    public function testCanGetByIp()
    {
        $country = $this->country->getByIp(1222974649);

        $this->assertInstanceOf(self::COUNTRY_CLASS, $country);
        $this->assertNotEquals(0, $country->nations()->count());
    }
}
