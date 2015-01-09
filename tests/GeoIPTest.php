<?php namespace Arcanedev\GeoIP\Tests;

use Arcanedev\GeoIP\GeoIP;

class GeoIPTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    const GEOIP_CLASS = 'Arcanedev\\GeoIP\\GeoIP';
    /** @var GeoIP */
    private $geoIp;
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->geoIp = new GeoIP;
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->geoIp);
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
        $this->assertInstanceOf(self::GEOIP_CLASS, $this->geoIp);
        $this->assertNotEmpty($this->geoIp->getIp());
    }

    /**
     * @test
     */
    public function testCanSetAndGetIP()
    {
        $this->assertNotEmpty($this->geoIp->getCurrentIp());
        var_dump($this->geoIp->getCurrentIp()); // To see the travis IP

        $ip = '192.168.1.1';
        $this->geoIp->setIp($ip);

        $this->assertEquals($ip, $this->geoIp->getIp());
    }

    /**
     * @test
     *
     * @expectedException \Arcanedev\GeoIP\Exceptions\InvalidTypeException
     * @expectedExceptionMessage The IP Address must be a string value, integer is given
     */
    public function testMustThrowInvalidTypeExceptionOnIP()
    {
        $this->geoIp->setIp(0);
    }

    /**
     * @test
     *
     * @expectedException \Arcanedev\GeoIP\Exceptions\InvalidIPAddressException
     * @expectedExceptionMessage The IP Address is not valid [hello]
     */
    public function testMustThrowInvalidIPAddressExceptionOnIP()
    {
        $this->geoIp->setIp('hello');
    }

    /**
     * @test
     */
    public function testCanConvertIpToLong()
    {
        $this->assertEquals(
            1,
            GeoIP::toLong('0.0.0.1')
        );
        $this->assertEquals(
            4294967294,
            GeoIP::toLong('255.255.255.254')
        );
        $this->assertEquals(
            2130706433,
            GeoIP::toLong('127.0.0.1')
        );
        $this->assertEquals(
            3232235777,
            GeoIP::toLong('192.168.1.1')
        );
        // New York
        $this->assertEquals(
            1222974649,
            GeoIP::toLong('72.229.28.185')
        );
        // Tokyo
        $this->assertEquals(
            1980140047,
            GeoIP::toLong('118.6.138.15')
        );
    }

    /**
     * @test
     */
    public function testCanConvertLongToIp()
    {
        $this->assertEquals(
            '0.0.0.1',
            GeoIP::toIp(1)
        );
        $this->assertEquals(
            '255.255.255.254',
            GeoIP::toIp(4294967294)
        );
        $this->assertEquals(
            '127.0.0.1',
            GeoIP::toIp(2130706433)
        );
        $this->assertEquals(
            '192.168.1.1',
            GeoIP::toIp(3232235777)
        );

        // New York
        $this->assertEquals(
            '72.229.28.185',
            GeoIP::toIp(1222974649)
        );
        // Tokyo
        $this->assertEquals(
            '118.6.138.15',
            GeoIP::toIp(1980140047)
        );
    }
}
