<?php namespace Arcanedev\GeoIP\Laravel\Commands;

class BaseCommand extends \Illuminate\Console\Command
{
    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }
}
