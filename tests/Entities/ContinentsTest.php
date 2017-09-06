<?php namespace Arcanedev\GeoIP\Tests\Entities;

use Arcanedev\GeoIP\Tests\TestCase;

/**
 * Class     ContinentsTest
 *
 * @package  Arcanedev\GeoIP\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ContinentsTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoIP\Entities\Continents */
    protected $continents;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->continents = \Arcanedev\GeoIP\Entities\Continents::load();
    }

    public function tearDown()
    {
        unset($this->continents);

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
            \Illuminate\Support\Collection::class,
            \Arcanedev\Support\Collection::class,
            \Arcanedev\GeoIP\Entities\Continents::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->continents);
        }

        $this->assertFalse($this->continents->isEmpty());
        $this->assertCount(252, $this->continents);
    }

    /** @test */
    public function it_can_get_continent()
    {
        $expectations = [
            'FR' => 'EU',
            'JP' => 'AS',
            'KI' => 'OC',
            'MA' => 'AF',
        ];

        foreach ($expectations as $key => $expected) {
            $this->assertSame($expected, $this->continents->get($key));
        }

        $this->assertNull($this->continents->get('ZZ'));
        $this->assertSame('Unknown', $this->continents->get('ZZ', 'Unknown'));
    }
}
