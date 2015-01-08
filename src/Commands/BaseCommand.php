<?php namespace Arcanedev\GeoIP\Commands;

use Illuminate\Console\Command;

class BaseCommand extends Command
{
    /* ------------------------------------------------------------------------------------------------
     |  Constrcutor
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
