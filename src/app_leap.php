<?php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$routes = new Routing\RouteCollection();

$routes->add('leap_year', new Routing\Route('/leap-year/{year}', array(
    'year' => null,
    '_controller' => 'UndiqTest\\Controller\\LeapYearController::indexAction'
)));

return $routes;