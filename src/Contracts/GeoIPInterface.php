<?php namespace Arcanedev\GeoIP\Contracts;

interface GeoIPInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Current IP
     *
     * @return string|null
     */
    public function getCurrentIp();

    /**
     * Get IP
     *
     * @return string
     */
    public function getIp();

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
    public static function toIp($long);

    /**
     * Convert IP to Long
     *
     * @param string $ip
     *
     * @return string
     */
    public static function toLong($ip);
}
