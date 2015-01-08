<?php namespace Arcanedev\GeoIP;

use Illuminate\Support\Facades\Request;
use Arcanedev\GeoIP\Models\Country;

use Arcanedev\GeoIP\Exceptions\InvalidIPAddressException;

use Arcanedev\GeoIP\Contracts\GeoIPInterface;

class GeoIP implements GeoIPInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var string */
    private $ip;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
    }

    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Current IP
     *
     * @return string|null
     */
    public function getCurrentIp()
    {
        return Request::ip();
    }

    /**
     * Get IP
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set IP
     *
     * @param string $ip
     *
     * @return $this
     */
    protected function setIp($ip)
    {
        $this->checkIp($ip);

        $this->ip = $ip;

        return $this;
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Country By Ip
     *
     * @param string $ip
     *
     * @return Country
     */
    public function country($ip = '')
    {
        if (empty($ip)) {
            $ip = $this->getCurrentIp();
        }

        $this->setIp($ip);

        return Country::getByIp($this->ip);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Convert Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Convert Long to IP
     *
     * @param $long
     *
     * @return string
     */
    public static function toIp($long)
    {
        $long = 4294967295 - ($long - 1);

        return long2ip(-$long);
    }

    /**
     * Convert IP to Long
     *
     * @param string $ip
     *
     * @return string
     */
    public static function toLong($ip)
    {
        return sprintf("%u", ip2long($ip));
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * @param string $ip
     *
     * @throws InvalidIPAddressException
     */
    private function checkIp(&$ip)
    {
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new InvalidIPAddressException();
        }
    }
}
