<?php namespace Arcanedev\GeoIP\Drivers;

use Arcanedev\GeoIP\Tasks\DownloadMaxmindDatabaseTask;
use GeoIp2\Database\Reader;

/**
 * Class     MaxmindDatabaseDriver
 *
 * @package  Arcanedev\GeoIP\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaxmindDatabaseDriver extends AbstractDriver
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Driver reader instance.
     *
     * @var \GeoIp2\Database\Reader
     */
    protected $reader;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the database path.
     *
     * @return string|null
     */
    private function getDatabasePath()
    {
        return $this->getOption('database-path');
    }

    /**
     * Get the locales.
     *
     * @return array
     */
    private function getLocales()
    {
        return $this->getOption('locales', ['en']);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Init the driver.
     */
    protected function init()
    {
        $this->checkDatabaseFile();

        $this->reader = new Reader(
            $this->getDatabasePath(),
            $this->getLocales()
        );
    }

    /**
     * Locate the ip address.
     *
     * @param  string  $ipAddress
     *
     * @return \Arcanedev\GeoIP\Location
     */
    public function locate($ipAddress)
    {
        $record = $this->reader->city($ipAddress);

        return $this->hydrate([
            'ip'          => $ipAddress,
            'iso_code'    => $record->country->isoCode,
            'country'     => $record->country->name,
            'city'        => $record->city->name,
            'state'       => $record->mostSpecificSubdivision->name,
            'state_code'  => $record->mostSpecificSubdivision->isoCode,
            'postal_code' => $record->postal->code,
            'latitude'    => $record->location->latitude,
            'longitude'   => $record->location->longitude,
            'timezone'    => $record->location->timeZone,
            'continent'   => $record->continent->code,
        ]);
    }

    /**
     * Update function for service.
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function update()
    {
        return DownloadMaxmindDatabaseTask::run(
            $this->getOption('update-url'),
            $this->getDatabasePath()
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the database exists.
     *
     * @return bool
     */
    private function isDatabaseExists()
    {
        return file_exists($this->getDatabasePath());
    }

    /**
     * Check if database file exists, otherwise copy the dummy one.
     */
    private function checkDatabaseFile()
    {
        if ($this->isDatabaseExists()) return;

        $pathinfo = pathinfo($path = $this->getDatabasePath());

        if ( ! file_exists($pathinfo['dirname'])) {
            mkdir($pathinfo['dirname'], 0777, true);
        }

        copy(realpath(__DIR__ . '/../../data/geoip.mmdb'), $path);
    }
}
