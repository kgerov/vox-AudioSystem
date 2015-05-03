<?php

namespace Vox;

class FrontController {
	private static $_instance = null;

	private function __construct() {

	}

	public function dispatch() {
		$a = new \Vox\Routers\DefaultRouter();
		
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

	public function getDefaultController() {
		$controller = \Vox\App::getInstance()->getConfig()->app['default_controller'];
		if ($controller) {
			return $controller;
		}

		return 'Index';
	}

	public function getDefaultMethod() {
		$method = \Vox\App::getInstance()->getConfig()->app['default_method'];
		if ($method) {
			return $method;
		}

		return 'index';
	}
}