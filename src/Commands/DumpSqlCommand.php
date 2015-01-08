<?php namespace Arcanedev\GeoIP\Commands;

use Arcanedev\GeoIP\Collections\CountriesCollection;
use Arcanedev\GeoIP\Collections\NationsCollection;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class DumpSqlCommand extends BaseCommand
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'geo-ip:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GeoIP Dump SQL File Command.';

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $nationsTable   = 'geo_nations';
        $nationsSeeds   = NationsCollection::init();
        $countriesTable = 'geo_countries';
        $countriesSeeds = CountriesCollection::init();
        $data           = compact('nationsTable', 'nationsSeeds', 'countriesTable', 'countriesSeeds');

        $file           = View::make('geo-ip::sql-file', $data)->render();

        $path           = $this->getDumpPath();

        if (File::exists($path)) {
            File::delete($path);
        }

        File::put($path, $file);

        $this->info('The SQL file was successfully generated !');
        $this->comment('Path [' . $path . ']');
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Config
     *
     * @param string $name
     *
     * @return string
     */
    public function getConfig($name)
    {
        return Config::get('geo-ip::config.' . $name);
    }

    /**
     * Get Dump Path
     *
     * @return string
     */
    public function getDumpPath()
    {
        return $this->getConfig('dump');
    }
}
