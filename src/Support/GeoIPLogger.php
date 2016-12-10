<?php namespace Arcanedev\GeoIP\Support;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class     GeoIPLogger
 *
 * @package  Arcanedev\GeoIP\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeoIPLogger
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Log the exception.
     *
     * @param  \Exception  $e
     */
    public static function log(\Exception $e)
    {
        if (config('geoip.log-failures.enabled', false)) {
            $path = config('geoip.log-failures.path', storage_path('logs/geoip.log'));

            $log = new Logger('geoip');
            $log->pushHandler(new StreamHandler($path, Logger::ERROR));
            $log->addError($e);
        }
    }
}
