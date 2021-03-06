<?php namespace Arcanedev\GeoIP\Drivers;

use GeoIp2\WebService\Client;

/**
 * Class     MaxmindApiDriver
 *
 * @package  Arcanedev\GeoIP\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaxmindApiDriver extends AbstractDriver
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Http client instance.
     *
     * @var \GeoIp2\WebService\Client
     */
    protected $client;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Init the driver.
     */
    protected function init()
    {
        $this->client = new Client(
            $this->getOption('user_id'),
            $this->getOption('license_key'),
            $this->getOption('locales', ['en'])
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
        $record = $this->client->city($ipAddress);

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
}
