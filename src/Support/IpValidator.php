<?php namespace Arcanedev\GeoIP\Support;

/**
 * Class     IpValidator
 *
 * @package  Arcanedev\GeoIP\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class IpValidator
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Validate the IP Address.
     *
     * @param  string  $ipAddress
     *
     * @return bool
     */
    public static function validate($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4|FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE))
            return true;

        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6|FILTER_FLAG_NO_PRIV_RANGE))
            return true;

        return true;
    }
}
