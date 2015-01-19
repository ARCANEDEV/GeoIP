<?php namespace Arcanedev\GeoIP\Tests;

use Illuminate\Foundation\Application;

abstract class LaravelTestCase extends \Orchestra\Testbench\TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Package Providers
     *
     * @return array
     */
    protected function getPackageProviders()
    {
        return [
            'Arcanedev\GeoIP\ServiceProvider'
        ];
    }

    /**
     * Get Package Aliases
     *
     * @return array
     */
    protected function getPackageAliases()
    {
        return [
            'GeoIP' => 'Arcanedev\GeoIP\Facade'
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['path.base']     = realpath(__DIR__ . '/../src');
        $app['path.database'] = realpath(__DIR__ . '/database');

        $app['config']->set('database.connections',[
            'testbench' => [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ],
            'testing'   => [
                'driver'   => 'sqlite',
                'database' => $app['path.database'] . '/testing.sqlite',
                'prefix'   => '',
            ],
        ]);

        $this->setPackageConfig($app);
    }

    /**
     * Define Package config
     *
     * @param Application $app
     * @param string      $connection
     */
    protected function setPackageConfig($app, $connection = 'testbench')
    {
        $app['config']->set('database.default', $connection);

        $app['config']->set('geo-ip::config', [
            'connection' => $connection,
            'prefix'     => 'geo_',
            'table'      => [
                'nations'   => 'nations',
                'countries' => 'countries',
            ],
            'dump'       => $app['path.database'] . '/geo-db.sql',
        ]);
    }
}
