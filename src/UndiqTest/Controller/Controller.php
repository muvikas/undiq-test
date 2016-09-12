<?php
namespace UndiqTest\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    protected function render($route, $args)
    {
		extract($args, EXTR_SKIP);
		ob_start();
		include sprintf(__DIR__.'/../../pages/%s.php', $route);

		return new Response(ob_get_clean());
    }
}