<?php namespace Arcanedev\GeoIP\Support;

/**
 * Class     IpDetector
 *
 * @package  Arcanedev\GeoIP\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class IpDetector
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    protected static $default = '127.0.0.0';

    /** @var array */
    protected static $remotes = [
        'HTTP_X_FORWARDED_FOR',
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR',
        'HTTP_X_CLUSTER_CLIENT_IP',
    ];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Detect the IP address.
     *
     * @return string
     */
    public static function detect()
    {
        foreach (static::$remotes as $remote) {
            if ($address = getenv($remote)) {
                foreach (explode(',', $address) as $ipAddress) {
                    if (IpValidator::validate($ipAddress)) return $ipAddress;
                }
            }
        }

        return static::$default;
    }
}
