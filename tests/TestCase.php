<?php namespace Arcanedev\GeoIP\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
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
    protected function getPackageProviders()
    {
        return [
            'Arcanedev\GeoIP\ServiceProvider'
        ];
    }

    protected function getPackageAliases()
    {
        return [
            'GeoIP' => 'Arcanedev\GeoIP\Facade'
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['path.base']     = __DIR__ . '/../src';
        $app['path.database'] = $app['path.base'];

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $this->setPackageConfig($app);
    }

    /**
     * Define Package config
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    private function setPackageConfig($app)
    {
        $app['config']->set('geo-ip::config', [
            'connection' => 'testbench',
            'prefix'     => 'geo_',
            'table'      => [
                'nations'   => 'nations',
                'countries' => 'countries',
            ],
            'dump'       => $app['path.database'] . '/geo-db.sql'
        ]);
    }
}
