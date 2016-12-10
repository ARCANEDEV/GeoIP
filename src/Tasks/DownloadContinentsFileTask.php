<?php namespace Arcanedev\GeoIP\Tasks;

/**
 * Class     DownloadContinentsFileTask
 *
 * @package  Arcanedev\GeoIP\Tasks
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DownloadContinentsFileTask
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Download and save the continents file.
     *
     * @param  string  $url
     * @param  string  $path
     *
     * @return bool
     */
    public static function run($url, $path)
    {
        $content = explode("\n", file_get_contents($url));

        array_shift($content);

        $continents = [];

        foreach (array_filter($content) as $data) {
            list($country, $continent) = explode(',', $data);

            $continents[$country] = $continent;
        }

        file_put_contents($path, json_encode($continents));

        return true;
    }
}
