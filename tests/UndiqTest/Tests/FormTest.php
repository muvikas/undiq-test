<?php
namespace UndiqTest\Tests;

use UndiqTest\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing;

class FrameworkTest extends \PHPUnit_Framework_TestCase
{
	
	public function testForm()
	{
		$matcher = $this->createMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
		$matcher
			->expects($this->once())
			->method('match')
			->will($this->returnValue(array(
				'_route' => 'main',
				'_controller' => 'UndiqTest\\Controller\\MainController::indexAction'
			)))
		;
		$matcher
			->expects($this->once())
			->method('getContext')
			->will($this->returnValue($this->createMock('Symfony\Component\Routing\RequestContext')))
		;
		$controllerResolver = new ControllerResolver();
		$argumentResolver = new ArgumentResolver();

		$framework = new Framework($matcher, $controllerResolver, $argumentResolver);

		$response = $framework->handle(new Request());

		$this->assertEquals(200, $response->getStatusCode());
		$this->assertContains('Most work ever', $response->getContent());
	}
	
	public function testResponse() {
		
		$matcher = $this->createMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
		$matcher
			->expects($this->once())
			->method('match')
			->will($this->returnValue(array(
				'_route' => 'main',
				'_controller' => 'UndiqTest\\Controller\\MainController::responseAction'
			)))
		;
		$matcher
			->expects($this->once())
			->method('getContext')
			->will($this->returnValue($this->createMock('Symfony\Component\Routing\RequestContext')))
		;
		$controllerResolver = new ControllerResolver();
		$argumentResolver = new ArgumentResolver();

		$framework = new Framework($matcher, $controllerResolver, $argumentResolver);
		$req = Request::create('/response', 'POST', array('simpleInput' => 'test-data-111111'));
		$req->overrideGlobals();
		$response = $framework->handle( $req );

        $this->assertEquals(200, $response->getStatusCode());
		$this->assertContains('test-data-111111', $response->getContent());
	}
	
	public function testNullResponse() {
		
		$matcher = $this->createMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
		$matcher
			->expects($this->once())
			->method('match')
			->will($this->returnValue(array(
				'_route' => 'main',
				'_controller' => 'UndiqTest\\Controller\\MainController::responseAction'
			)))
		;
		$matcher
			->expects($this->once())
			->method('getContext')
			->will($this->returnValue($this->createMock('Symfony\Component\Routing\RequestContext')))
		;
		$controllerResolver = new ControllerResolver();
		$argumentResolver = new ArgumentResolver();

		$framework = new Framework($matcher, $controllerResolver, $argumentResolver);

		$req = new Request();
		$req->overrideGlobals();
		
		$response = $framework->handle( $req );

        $this->assertEquals(200, $response->getStatusCode());
		$this->assertContains('No input', $response->getContent());
	}
	
}