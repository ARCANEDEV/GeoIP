<?php namespace Arcanedev\GeoIP\Drivers;

use Arcanedev\GeoIP\Entities\Continents;
use Exception;
use GuzzleHttp\Client;

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
        $this->client = new Client(
            $this->getHttpClientConfig()
        );

        $this->continents = Continents::make();
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
            'continent'   => $this->continents->get($data->countryCode, 'Unknown'),
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
        // Do nothing

        return true;
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
