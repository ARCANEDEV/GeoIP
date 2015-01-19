<?php namespace Arcanedev\GeoIP;

use Illuminate\Support\Facades\Request;
use Arcanedev\GeoIP\Laravel\Models\Country;

use Arcanedev\GeoIP\Exceptions\InvalidTypeException;
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
        $this->ip = '';
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
        if (empty($this->ip)) {
            $this->ip = $this->getCurrentIp();
        }

        return $this->ip;
    }

    /**
     * Set IP
     *
     * @param string $ip
     *
     * @return $this
     */
    public function setIp($ip)
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
     * @return Country|null
     */
    public function country($ip = '')
    {
        if (empty($ip)) {
            $ip = $this->getIp();
        }

        $this->setIp($ip);

        if ($this->isLocalhost()) {
            return null;
        }

        $longIp = GeoIP::toLong($this->ip);

        return Country::getByIp($longIp);
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

    /**
     * Check if IP Address is a local machine
     *
     * @return bool
     */
    protected function isLocalhost()
    {
        return $this->ip == '127.0.0.1';
    }

    /* ------------------------------------------------------------------------------------------------
     |  Check Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Check IP Address
     *
     * @param string $ip
     *
     * @throws InvalidTypeException
     * @throws InvalidIPAddressException
     */
    private function checkIp(&$ip)
    {
        if (! is_string($ip)) {
            throw new InvalidTypeException(
                'The IP Address must be a string value, '. gettype($ip) . ' is given'
            );
        }

        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new InvalidIPAddressException(
                'The IP Address is not valid [' . $ip .']'
            );
        }
    }
}
