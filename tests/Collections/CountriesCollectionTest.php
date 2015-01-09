<?php namespace Arcanedev\GeoIP\Tests\Collections;

use Arcanedev\GeoIP\Collections\CountriesCollection;
use Arcanedev\GeoIP\Tests\TestCase;

class CountriesCollectionTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var CountriesCollection */
    private $collection;

    const COUNTRIES_COLLECTION_CLASS = 'Arcanedev\\GeoIP\\Collections\\CountriesCollection';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->collection = new CountriesCollection;
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->collection);
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
        $this->assertInstanceOf(
            self::COUNTRIES_COLLECTION_CLASS,
            $this->collection
        );
        $this->assertCount(0, $this->collection);
    }

    /**
     * @test
     */
    public function testCanMake()
    {
        $this->collection = CountriesCollection::init();

        $this->assertInstanceOf(
            self::COUNTRIES_COLLECTION_CLASS,
            $this->collection
        );
        $this->assertNotEmpty($this->collection);
        $this->assertCount(246, $this->collection);
    }
}
