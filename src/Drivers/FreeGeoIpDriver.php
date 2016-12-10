<?php namespace Arcanedev\GeoIP\Drivers;

use Arcanedev\GeoIP\Entities\Continents;
use GuzzleHttp\Client;

/**
 * Class     FreeGeoIpDriver
 *
 * @package  Arcanedev\GeoIP\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FreeGeoIpDriver extends AbstractDriver
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Http client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * A collection of continents.
     *
     * @var \Arcanedev\GeoIP\Entities\Continents
     */
    protected $continents;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Init the driver.
     */
    protected function init()
    {
        $this->client = new Client([
            'base_uri' => 'http://freegeoip.net/',
            'headers' => [
                'User-Agent' => 'Laravel-GeoIP',
            ]
        ]);

        $this->continents = Continents::make();
    }

    /**
     * Locate the ip address.
     *
     * @param  string $ipAddress
     *
     * @return \Arcanedev\GeoIP\Location
     */
    public function locate($ipAddress)
    {
        $response = $this->client->get("json/$ipAddress");

        $data = json_decode($response->getBody());

        return $this->hydrate([
            'ip'          => $ipAddress,
            'iso_code'    => $data->country_code,
            'country'     => $data->country_name,
            'city'        => $data->city,
            'state'       => $data->region_name,
            'state_code'  => $data->region_code,
            'postal_code' => $data->zip_code,
            'latitude'    => $data->latitude,
            'longitude'   => $data->longitude,
            'timezone'    => $data->time_zone,
            'continent'   => $this->continents->get($data->country_code, 'Unknown'),
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
        // Do nothing

        return true;
    }
}
