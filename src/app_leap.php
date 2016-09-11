<?php
use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class LeapYearController
{
    public function indexAction($year)
    {
        if ($this->is_leap_year($year)) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
	
	private function is_leap_year($year = null) {
		if (null === $year) {
			$year = date('Y');
		}

		return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
	}
}

$routes = new Routing\RouteCollection();

$routes->add('leap_year', new Routing\Route('/leap-year/{year}', array(
    'year' => null,
    '_controller' => 'LeapYearController::indexAction'
)));

$routes->add('hello', new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => function ($request) {
        return render_template($request);
    }
)));
$routes->add('bye', new Routing\Route('/bye'));

return $routes;