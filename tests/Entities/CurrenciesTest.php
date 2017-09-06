<?php namespace Arcanedev\GeoIP\Tests\Entities;

use Arcanedev\GeoIP\Tests\TestCase;

/**
 * Class     CurrenciesTest
 *
 * @package  Arcanedev\GeoIP\Tests\Entities
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CurrenciesTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\GeoIP\Entities\Currencies */
    protected $currencies;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function setUp()
    {
        parent::setUp();

        $this->currencies = \Arcanedev\GeoIP\Entities\Currencies::load();
    }

    public function tearDown()
    {
        unset($this->currencies);

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
            \Arcanedev\GeoIP\Entities\Currencies::class,
        ];

        foreach ($expectations as $expected) {
            $this->assertInstanceOf($expected, $this->currencies);
        }

        $this->assertFalse($this->currencies->isEmpty());
        $this->assertCount(247, $this->currencies);
    }

    /** @test */
    public function it_can_get_continent()
    {
        $expectations = [
            'FR' => 'EUR',
            'JP' => 'JPY',
            'MA' => 'MAD',
        ];

        foreach ($expectations as $key => $expected) {
            $this->assertSame($expected, $this->currencies->get($key));
        }

        $this->assertNull($this->currencies->get('ZZ'));
        $this->assertSame('Unknown', $this->currencies->get('ZZ', 'Unknown'));
    }
}
