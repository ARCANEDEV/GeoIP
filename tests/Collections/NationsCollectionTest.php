<?php namespace Arcanedev\GeoIP\Tests\Collections;

use Arcanedev\GeoIP\Collections\NationsCollection;

use Arcanedev\GeoIP\Tests\TestCase;

class NationsCollectionTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var NationsCollection */
    private $collection;

    const NATIONS_COLLECTION_CLASS = 'Arcanedev\\GeoIP\\Collections\\NationsCollection';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $this->collection = new NationsCollection;
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
            self::NATIONS_COLLECTION_CLASS,
            $this->collection
        );
        $this->assertCount(0, $this->collection);
    }

    /**
     * @test
     */
    public function testCanMake()
    {
        $this->collection = NationsCollection::init();

        $this->assertInstanceOf(
            self::NATIONS_COLLECTION_CLASS,
            $this->collection
        );
        $this->assertNotEmpty($this->collection);
        $this->assertCount(62601, $this->collection);
    }
}
