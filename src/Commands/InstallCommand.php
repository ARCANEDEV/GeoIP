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
    /**
     * Run Migrations
     *
     * @return void
     */
    private function runMigrations()
    {
        $options = [
            '--package' => 'arcanedev/geo-ip',
        ];

        //if (! is_null($this->option('env'))) {
        //    $options['--env'] = $this->option('env');
        //}

        if ($this->getLaravel()->environment('testing')){
            $options['--database'] = 'testbench';
            $options['--path']     = 'migrations';
        }

        $this->call('migrate', $options);
    }

    /**
     * Run Seeds
     *
     * @return void
     */
    private function runSeeds()
    {
        $options = [
            '--class' => 'Arcanedev\\GeoIP\\Seeds\\DatabaseSeeder'
        ];

        if ($this->getLaravel()->environment('testing')){
            $options['--database'] = 'testbench';
        }

        $this->call('db:seed', $options);
    }
}
