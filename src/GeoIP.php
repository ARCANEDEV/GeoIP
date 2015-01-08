<?php namespace Arcanedev\GeoIP;

use Arcanedev\GeoIP\Contracts\GeoIPInterface;
use Arcanedev\GeoIP\Exceptions\InvalidIPAddressException;

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
        if (! isset($_SERVER['REMOTE_ADDR'])) {
            return null;
        }

        return $_SERVER['REMOTE_ADDR'];
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
