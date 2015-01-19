<?php namespace Arcanedev\GeoIP\Laravel\Commands;

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
            '--path'    => 'Laravel/migrations',
        ];

        //if (! is_null($this->option('env'))) {
        //    $options['--env'] = $this->option('env');
        //}

        $this->setTestingOptions($options);

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
            '--class' => 'Arcanedev\\GeoIP\\Laravel\\Seeds\\DatabaseSeeder'
        ];

        $this->setTestingOptions($options);

        $this->call('db:seed', $options);
    }

    /**
     * Set additional Options for testing
     *
     * @param array $options
     */
    private function setTestingOptions(&$options)
    {
        if ($this->getLaravel()->environment('testing')){
            $options['--database'] = 'testbench';
        }
    }
}
