<?php

namespace Controllers;

class Index {
	public function index() {
		//echo "default controller";

		$view = \Vox\View::getInstance();
		$view->username = 'kgerov';
		$view->appendToLayout('body', 'admin.index');
		$view->appendToLayout('body2', 'index');
		$view->display('layouts.default2', array('c' => array(1,2,3,4,4))); 
	}
}

//$view->display('admin.index', array('c' => array(1,2,3,4,4))); 
//give second parameter array if you don't want to give the info one by one
//to get into a folder: admin.index (use dot as folder seperator)

//as string
// $a = $view->display('admin.index', array('c' => array(1,2,3,4,4)), true);
// echo $a;