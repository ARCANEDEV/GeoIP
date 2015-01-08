<?php namespace Arcanedev\GeoIP\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command
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
    protected $name = 'geo-ip:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'GeoIP Install Command [Migration + Seeds].';

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
        $this->runMigrations();

        $this->runSeeds();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    private function runMigrations()
    {
        $this->call('migrate', [
            '--env'   => $this->option('env'),
            '--bench' =>'arcanedev/geo-ip'
        ]);
    }

    private function runSeeds()
    {
        $this->call('db:seed', [
            '--class'   => 'Arcanedev\\GeoIP\\Seeds\\DatabaseSeeder'
        ]);
    }
}
