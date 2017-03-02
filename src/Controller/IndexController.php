<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 02.03.17
 * Time: 20:16
 */

namespace src\Controller;
require_once __DIR__ . "/../Util/IssManager.php";
require_once __DIR__ . "/../Util/ReverseGeoCoder.php";

use src\Util\IssManager;
use src\Util\ReverseGeoCoder;

class IndexController
{
    private function getAddress()
    {
        $issPosition = IssManager::getPosition();

        $geocoder = new ReverseGeoCoder($issPosition);

        return $geocoder->getHumanReadableAddress();
    }

    public function indexAction()
    {
        $address = $this->getAddress();

        $content = file_get_contents(__DIR__ . "/../../views/index.html");

        $content = str_replace('{{ position }}', $address, $content);

        return $content;
    }

    /**
     * @return string
     */
    public function ajaxAction()
    {
        return $this->getAddress();
    }
}