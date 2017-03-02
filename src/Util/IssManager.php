<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 02.03.17
 * Time: 19:52
 */

namespace src\Util;
require_once __DIR__ . "/GeoPosition.php";


class IssManager
{
    public static function getPosition()
    {

        $pos = file_get_contents('https://api.wheretheiss.at/v1/satellites/25544');
        $pos = json_decode($pos, true);

        $lat = $pos['latitude'] ?? 0;
        $lng = $pos['longitude'] ?? 0;

        return new GeoPosition(floatval($lat), floatval($lng));
    }
}