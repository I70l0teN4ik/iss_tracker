<?php

require_once __DIR__ . "/Controller/IndexController.php";

$controller = new \src\Controller\IndexController();

//die(var_dump($_SERVER));
if ($_SERVER['REQUEST_URI'] == '/ajax') {
    return $controller->ajaxAction();
} else {
    return $controller->indexAction();
}
