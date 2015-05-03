<?php

namespace Vox;

class FrontController {
	private static $_instance = null;

	private function __construct() {

	}

	public function dispatch() {
		$a = new \Vox\Routers\DefaultRouter();
		$a->parse();
	}

	/**
	*
	* @return \Vox\FrontController
	*/
	public static function getInstance() {
		if(self::$_instance == null) {
			self::$_instance = new \Vox\FrontController();
		}

		return self::$_instance;
	}
}