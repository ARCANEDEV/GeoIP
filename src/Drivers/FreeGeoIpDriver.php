<?php namespace Arcanedev\GeoIP\Drivers;

use Arcanedev\GeoIP\Tasks\DownloadContinentsFileTask;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

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
     * An array of continents.
     *
     * @var array
     */
    protected $continents = [];

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

        // Set continents
        if (file_exists($path = $this->getOption('continents-path'))) {
            $this->continents = json_decode(file_get_contents($path), true);
        }
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
            'continent'   => $this->getContinent($data->country_code),
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
        return DownloadContinentsFileTask::run(
            'http://dev.maxmind.com/static/csv/codes/country_continent.csv',
            $this->getOption('continents-path')
        );
    }

    /**
     * Get continent based on country code.
     *
     * @param  string  $code
     *
     * @return string
     */
    private function getContinent($code)
    {
        return Arr::get($this->continents, $code, 'Unknown');
    }
}
