<?php
namespace UndiqTest\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use UndiqTest\Model\Form;

class MainController extends Controller
{
    public function indexAction()
    {
		$request = Request::createFromGlobals();
		
		$vars = array();
		$vars['returnRoute'] = 'response';
		
		return $this->render('main', $vars);
    }
	
    public function responseAction()
    {
		$request = Request::createFromGlobals();
		
		$vars = array();
		
		$vars['input'] = $request->request->get('simpleInput', 'No input');
		
		return $this->render('response', $vars);
    }
}