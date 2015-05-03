<?php

namespace Vox;
include 'Loader.php';

class App {
	private static $_instance = null;
	private $_config = null;
	/**
	*
	* @var \Vox\FrontController
	*/
	private $_frontController = null;

	private function __construct() {
		\Vox\Loader::registerNamespace('Vox', dirname(__FILE__).DIRECTORY_SEPARATOR);
		\Vox\Loader::registerAutoload();
		$this->_config = \Vox\Config::getInstance();
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}
	}

	public function setConfigFolder($path) {
		$this->_config->setConfigFolder($path);
	}

	public function getConfigFolder() {
		return $this->_configFolder;
	}

	/**
	*
	* @return \Vox\Config
	*/
	public function getConfig() {
		return $this->_config;
	}

	public function run() {
		if ($this->_config->getConfigFolder() == null) {
			$this->setConfigFolder('../config');
		}

		$this->_frontController = \Vox\FrontController::getInstance();
		$this->_frontController->dispatch();
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