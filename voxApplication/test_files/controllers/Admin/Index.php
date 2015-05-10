<?php

namespace Controllers\Admin;

class Index {
	public function index() {
		$view = \Vox\View::getInstance();
		//$view->appendToLayout('body', 'admin.index');
		//$view->appendToLayout('body2', 'index');
		$view->display('layouts.default2'); 
	}

	public function _new() {
		//echo "ebasi kefa";
	}
}