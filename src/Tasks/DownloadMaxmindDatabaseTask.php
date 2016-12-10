<?php namespace Arcanedev\GeoIP\Tasks;

use Exception;
use Illuminate\Support\Str;

/**
 * Class     DownloadMaxmindDatabaseTask
 *
 * @package  Arcanedev\GeoIP\Tasks
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DownloadMaxmindDatabaseTask
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Run the task.
     *
     * @param  string  $url   The database URL.
     * @param  string  $path  Destination path to save the file
     *
     * @return bool
     *
     * @throws Exception
     */
    public static function run($url, $path)
    {
        $path = static::checkDestinationPath($path);

        static::checkUrl($url);

        $tmpFile = tempnam(sys_get_temp_dir(), 'maxmind');
        file_put_contents($tmpFile, fopen($url, 'r'));

        file_put_contents($path, gzopen($tmpFile, 'r'));

        unlink($tmpFile);

        return true;
    }

    /**
     * Check the destination path.
     *
     * @param  string  $path
     *
     * @return string
     *
     * @throws Exception
     */
    private static function checkDestinationPath($path)
    {
        if (($path = realpath($path)) === false)
            throw new Exception('Database path not set in getOption file.');

        return $path;
    }

    /**
     * Check the url status.
     *
     * @param  string  $url
     *
     * @throws \Exception
     */
    private static function checkUrl($url)
    {
        $headers = get_headers($url);

        if ( ! Str::contains($headers[0], '200 OK')) {
            throw new Exception('Unable to download Maxmind\'s database. ('. substr($headers[0], 13) .')');
        }
    }
}
