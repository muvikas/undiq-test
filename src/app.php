<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('form', new Routing\Route('/', array(
    '_controller' => 'UndiqTest\\Controller\\MainController::indexAction'
)));
$routes->add('response', new Routing\Route('/response', array(
    '_controller' => 'UndiqTest\\Controller\\MainController::responseAction'
)));

return $routes;