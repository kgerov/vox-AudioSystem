<?php

namespace Vox;
include 'Loader.php';

class App {
	private static $_instance = null;

	private function __construct() {
		\Vox\Loader::registerNamespace('Vox', dirname(__FILE__).DIRECTORY_SEPARATOR);
		\Vox\Loader::registerAutoload();
	}

	public function run() {
		echo "In app run" . '<br>';
	}

	/**
	*
	* @return \Vox\App
	*/

	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \Vox\App();
		}

		return self::$_instance;
	}
}