<?php namespace Arcanedev\GeoIP\Console;

use Arcanedev\GeoIP\Contracts\GeoIPDriver;
use Arcanedev\Support\Bases\Command;

/**
 * Class     UpdateCommand
 *
 * @package  Arcanedev\GeoIP\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateCommand extends Command
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
    protected $name = 'geoip:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update GeoIP database files to the latest version';

    /** @var  \Arcanedev\GeoIP\Contracts\GeoIPDriver */
    protected $driver;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UpdateCommand constructor.
     *
     * @param  \Arcanedev\GeoIP\Contracts\GeoIPDriver  $driver
     */
    public function __construct(GeoIPDriver $driver)
    {
        parent::__construct();

        $this->driver = $driver;
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
        $this->comment('Updating the driver database...');

        if ($this->driver->update())
            $this->info('Driver database updated');
        else
            $this->error('Update failed!');
    }
}
