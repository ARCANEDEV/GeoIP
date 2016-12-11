<?php namespace Arcanedev\GeoIP;

use Arcanedev\GeoIP\Contracts\GeoIP as GeoIPContract;
use Arcanedev\GeoIP\Contracts\GeoIPCache;
use Arcanedev\GeoIP\Contracts\GeoIPDriver;
use Arcanedev\GeoIP\Entities\Currencies;
use Arcanedev\GeoIP\Support\GeoIPLogger;
use Arcanedev\GeoIP\Support\IpDetector;
use Arcanedev\GeoIP\Support\IpValidator;
use Illuminate\Support\Arr;

/**
 * Class     GeoIP
 *
 * @package  Arcanedev\GeoIP
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIP implements GeoIPContract
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var \Arcanedev\GeoIP\Contracts\GeoIPDriver  */
    private $driver;

    /** @var \Arcanedev\GeoIP\Contracts\GeoIPCache  */
    private $cache;

    /** @var array */
    protected $config = [];

    /** @var  \Arcanedev\GeoIP\Location */
    protected $location;

    /** @var array */
    protected $defaultLocation = [];

    /** @var string */
    protected $remoteIp;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new GeoIP instance.
     *
     * @param  \Arcanedev\GeoIP\Contracts\GeoIPDriver  $driver
     * @param  \Arcanedev\GeoIP\Contracts\GeoIPCache   $cache
     * @param  array                                   $config
     */
    public function __construct(GeoIPDriver $driver, GeoIPCache $cache, array $config)
    {
        $this->driver = $driver;
        $this->cache  = $cache;
        $this->config = $config;

        $this->setDefaultLocation($this->config('location.default', []));
        $this->remoteIp = $this->defaultLocation['ip'] = IpDetector::detect();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the GeoIP driver instance.
     *
     * @return \Arcanedev\GeoIP\Contracts\GeoIPDriver
     */
    public function driver()
    {
        return $this->driver;
    }

    /**
     * Get cache instance.
     *
     * @return \Arcanedev\GeoIP\Contracts\GeoIPCache
     */
    public function cache()
    {
        return $this->cache;
    }

    /**
     * Get configuration value.
     *
     * @param  string  $key
     * @param  mixed   $default
     *
     * @return mixed
     */
    private function config($key, $default = null)
    {
        return Arr::get($this->config, $key, $default);
    }

    /**
     * Set the default location.
     *
     * @param  array  $location
     *
     * @return self
     */
    public function setDefaultLocation(array $location)
    {
        $this->defaultLocation = array_merge($this->defaultLocation, $location);

        return $this;
    }

    /**
     * Get the currency code from ISO.
     *
     * @param  string  $iso
     *
     * @return string
     */
    public function getCurrency($iso)
    {
        return (bool) $this->config('currencies.included', false)
            ? Currencies::make()->get($iso, $iso)
            : $iso;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the location from the provided IP.
     *
     * @param  string  $ipAddress
     *
     * @return \Arcanedev\GeoIP\Location
     */
    public function location($ipAddress = null)
    {
        $this->location = $this->find($ipAddress);

        if ($this->shouldCache($ipAddress, $this->location)) {
            $this->cache()->set($ipAddress, $this->location->toArray());
        }

        return $this->location;
    }

    /**
     * Find location from IP.
     *
     * @param  string  $ip
     *
     * @return \Arcanedev\GeoIP\Location
     *
     * @throws \Exception
     */
    private function find($ip = null)
    {
        if ($this->config('cache.mode', 'none') !== 'none' && $location = $this->cache()->get($ip)) {
            $location->setAttribute('cached', true);

            return $location;
        }

        $ip = $ip ?: $this->remoteIp;

        if (IpValidator::validate($ip)) {
            try {
                $location = $this->driver()->locate($ip);

                if (is_null($location->currency)) {
                    $location->setAttribute('currency', $this->getCurrency($location->iso_code));
                }

                $location->setAttribute('default', false);

                return $location;
            }
            catch (\Exception $e) {
                GeoIPLogger::log($e);
            }
        }

        return new Location($this->defaultLocation);
    }

    /**
     * Determine if the location should be cached.
     *
     * @param  string|null                $ipAddress
     * @param  \Arcanedev\GeoIP\Location  $location
     *
     * @return bool
     */
    private function shouldCache($ipAddress = null, Location $location)
    {
        if ($location->default === true || $location->cached === true)
            return false;

        switch ($this->config('cache.mode', 'none')) {
            case 'all':
                return true;

            case 'some':
                if (is_null($ipAddress))
                    return true;
        }

        return false;
    }
}
