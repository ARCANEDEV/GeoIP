<?php namespace Arcanedev\GeoIP\Drivers;

use Arcanedev\GeoIP\Tasks\DownloadContinentsFileTask;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

/**
 * Class     IpApiDriver
 *
 * @package  Arcanedev\GeoIP\Drivers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class IpApiDriver extends AbstractDriver
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
        $this->client = new Client(
            $this->getHttpClientConfig()
        );

        // Set continents
        if (file_exists($path = $this->getOption('continents-path'))) {
            $this->continents = json_decode(file_get_contents($path), true);
        }
    }

    /**
     * Locate the ip address.
     *
     * @param  string  $ipAddress
     *
     * @return \Arcanedev\GeoIP\Location
     *
     * @throws \Exception
     */
    public function locate($ipAddress)
    {
        $response = $this->client->get("json/$ipAddress");

        // Parse body content
        $data = json_decode($response->getBody());

        // Verify response status
        if ($data->status !== 'success') {
            throw new Exception("Request failed ({$data->message})");
        }

        return $this->hydrate([
            'ip'          => $ipAddress,
            'iso_code'    => $data->countryCode,
            'country'     => $data->country,
            'city'        => $data->city,
            'state'       => $data->regionName,
            'state_code'  => $data->region,
            'postal_code' => $data->zip,
            'latitude'    => $data->lat,
            'longitude'   => $data->lon,
            'timezone'    => $data->timezone,
            'continent'   => $this->getContinent($data->countryCode),
        ]);
    }

    /**
     * Update function for service.
     *
     * @return string
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

    /**
     * Get the http client config.
     *
     * @return array
     */
    private function getHttpClientConfig()
    {
        $config = [
            'base_uri' => 'http://ip-api.com/',
            'headers' => [
                'User-Agent' => 'Laravel-GeoIP',
            ],
            'query' => [
                'fields' => 16895,
            ],
        ];

        // Using the Pro service
        if ($this->getOption('key')) {
            $config['base_uri']     = $this->isSecure() ? 'https://pro.ip-api.com/' : 'http://pro.ip-api.com/';
            $config['query']['key'] = $this->getOption('key');
        }

        return $config;
    }

    /**
     * Check if secure url.
     *
     * @return bool
     */
    private function isSecure()
    {
        return (bool) $this->getOption('secure');
    }
}
