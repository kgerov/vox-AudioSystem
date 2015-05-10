<?php

namespace Controllers;

class Index extends \Controllers\BaseController {
	public function index() {
		//echo "default controller";

		//$this->app->displayError(404);
		//exit;
		

		$a = \Vox\InputData::getInstance()->get(0, 'int');
		echo $a;


		$val = new \Vox\Validation();
		$val->setRule('url', 'http://azc.com', '', 'wrong url')->setRule('minlength', 'http://azc.com', 5);
		//var_dump($val->validate());
		//print_r($val->getErrors());

		$val->setRule('custom', 4, function($a) {
			return $a%2 == 0;
		});
		//var_dump($val->validate());
		//print_r($val->getErrors());

		//$view = \Vox\View::getInstance();
		$this->view->username = 'kgerov';
		//$this->view->appendToLayout('body', 'admin.index');
		//$this->view->appendToLayout('body2', 'index');
		//$this->view->display('layouts.themesbase', array('c' => array(1,2,3,4,4)));

		$ab = $this->input->post("user");
		if (isset($ab)) {
			echo "<h1>" . $ab . "</h1>"; 
		}
	}
}

//$view->display('admin.index', array('c' => array(1,2,3,4,4))); 
//give second parameter array if you don't want to give the info one by one
//to get into a folder: admin.index (use dot as folder seperator)

//as string
// $a = $view->display('admin.index', array('c' => array(1,2,3,4,4)), true);
// echo $a;