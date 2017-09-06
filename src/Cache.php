<?php namespace Arcanedev\GeoIP;

use Arcanedev\GeoIP\Contracts\GeoIPCache;
use Illuminate\Contracts\Cache\Repository as Store;

/**
 * Class     Cache
 *
 * @package  Arcanedev\GeoIP
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Cache implements GeoIPCache
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Contracts\Cache\Repository */
    protected $store;

    /** @var array */
    protected $tags = [];

    /** @var int */
    protected $expires = 30;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Cache constructor.
     *
     * @param  \Illuminate\Contracts\Cache\Repository  $store
     * @param  array                                   $tags
     * @param  int                                     $expires
     */
    public function __construct(Store $store, array $tags, $expires = 30)
    {
        $this->store   = $store;
        $this->tags    = $tags;
        $this->expires = $expires;
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the store instance.
     *
     * @return \Illuminate\Contracts\Cache\Repository
     */
    private function store()
    {
        return empty($this->tags) ? $this->store : $this->store->tags($this->tags);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get an item from the cache.
     *
     * @param  string  $key
     *
     * @return \Arcanedev\GeoIP\Location|null
     */
    public function get($key)
    {
        return is_array($value = $this->store()->get($key)) ? new Location($value) : null;
    }

    /**
     * Set an item in cache.
     *
     * @param  string  $key
     * @param  array   $location
     */
    public function set($key, array $location)
    {
        $this->store()->put($key, $location, $this->expires);
    }

    /**
     * Flush cache for tags.
     */
    public function flush()
    {
        $this->store()->flush();
    }
}
