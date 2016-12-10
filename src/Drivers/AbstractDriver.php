<?php namespace Arcanedev\GeoIP\Drivers;

use Arcanedev\GeoIP\Contracts\GeoIPDriver;
use Arcanedev\GeoIP\Location;
use Illuminate\Support\Arr;

/**
 * Class     AbstractDriver
 *
 * @package  Arcanedev\GeoIP\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AbstractDriver implements GeoIPDriver
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Driver options.
     *
     * @var array
     */
    protected $options = [];

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * AbstractDriver constructor.
     *
     * @param  array  $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
        $this->init();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Init the driver.
     */
    abstract protected function init();

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get option value.
     *
     * @param  string  $key
     * @param  mixed   $default
     *
     * @return mixed
     */
    protected function getOption($key, $default = null)
    {
        return Arr::get($this->options, $key, $default);
    }

    /**
     * Hydrate the location entity.
     *
     * @param  array  $attributes
     *
     * @return \Arcanedev\GeoIP\Location
     */
    protected function hydrate(array $attributes = [])
    {
        return new Location($attributes);
    }
}
