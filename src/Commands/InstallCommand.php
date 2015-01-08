<?php namespace Arcanedev\GeoIP\Commands;

class InstallCommand extends BaseCommand
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
            '--env'     => $this->option('env'),
            '--package' =>'arcanedev/geo-ip'
        ]);
    }

    private function runSeeds()
    {
        $this->call('db:seed', [
            '--class'   => 'Arcanedev\\GeoIP\\Seeds\\DatabaseSeeder'
        ]);
    }
}
