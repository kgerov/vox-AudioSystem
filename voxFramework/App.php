<?php

namespace Vox;
include 'Loader.php';

class App {
	private static $_instance = null;
	private $_config = null;
	private $router = null;
	private $_dbConnections = array();
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

	public function getRouter() {
		return $this->router;
	}

	public function setRouter($router) {
		$this->router = $router;
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
		
		if ($this->router instanceof \Vox\Routers\IRouter) {
			$this->_frontController->setRouter($this->router);
		}
		else if($this->router == 'JsonRPCRouter') {
			$this->_frontController->setRouter(new \Vox\Routers\DefaultRouter());
		} else if($this->router == 'CLIRouter') {
			$this->_frontController->setRouter(new \Vox\Routers\DefaultRouter());
		} else {
			$this->_frontController->setRouter(new \Vox\Routers\DefaultRouter());
		}

		$this->_frontController->dispatch();
	}

	public function getDBConnection($connection = 'default') {
		if (!$connection) {
			throw new \Exception('No connection identifier provided', 500);
		}

		if ($this->_dbConnections[$connection]) {
			return $this->_dbConnections[$connection];
		}

		$_cnf = $this->getConfig()->database;

		if (!$_cnf[$connection]) {
			throw new \Exception('No valid connection identifier is provided', 500);
		}

		$dbh = new \PDO($_cnf[$connection]['connection_uri'], $_cnf[$connection]['username'],
			$_cnf[$connection]['password'], $_cnf[$connection]['pdo_options']);

		$this->_dbConnections[$connection] = $dbh;

		return $dbh; 
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