<?php

namespace Vox;

class FrontController {
	private static $_instance = null;

	private function __construct() {

	}

	public function dispatch() {

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