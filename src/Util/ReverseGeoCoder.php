<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 02.03.17
 * Time: 19:32
 */

namespace src\Util;


class ReverseGeoCoder
{
    private $pos;

    public function __construct(GeoPosition $geoPosition)
    {
        $this->pos = $geoPosition;
    }

    public function getHumanReadableAddress()
    {
        $geoURL = sprintf(
            "https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s",
            $this->pos->getLat(),
            $this->pos->getLng()
//            51.5033640,
//            -0.1276250
        );

        $resContent = file_get_contents($geoURL);

        $res = json_decode($resContent, true)['results'] ?? [];

        $res = array_filter($res, function($r) {
            $types = $r['types'] ?? array('route');
            return !in_array('route', $types);
        });

        return reset($res)['formatted_address'] ?? 'the ocean';
    }
}