<?php namespace Arcanedev\GeoIP\Console;

use Arcanedev\GeoIP\Contracts\GeoIPCache;
use Arcanedev\Support\Bases\Command;

/**
 * Class     ClearCommand
 *
 * @package  Arcanedev\GeoIP\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ClearCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'geoip:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear the GeoIP cached data.';

    /**
     * Supported cache stores.
     *
     * @var array
     */
    protected $supported = ['apc', 'array', 'memcached', 'redis'];

    /**
     * The GeoIP Cache instance.
     *
     * @var \Arcanedev\GeoIP\Contracts\GeoIPCache
     */
    private $cache;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * ClearCommand constructor.
     *
     * @param  \Arcanedev\GeoIP\Contracts\GeoIPCache  $cache
     */
    public function __construct(GeoIPCache $cache)
    {
        parent::__construct();

        $this->cache = $cache;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->isSupported($default = $this->getDefaultCache())) {
            $this->comment('Clearing the cache data...');

            $this->cache->flush();

            $this->info("Cache clearing was completed!");
        }
        else
            $this->error("Default cache system [$default] does not support tags");
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the config repository.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    protected function config()
    {
        return $this->laravel['config'];
    }

    /**
     * Get the default cache.
     *
     * @return string
     */
    protected function getDefaultCache()
    {
        return $this->config()->get('cache.default');
    }

    /**
     * Is cache flushing supported.
     *
     * @return bool
     */
    protected function isSupported($default)
    {
        return in_array($default, $this->supported) &&
               ! empty($this->config()->get('geoip.cache.tags', []));
    }
}
