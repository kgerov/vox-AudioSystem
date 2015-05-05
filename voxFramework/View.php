<?php

namespace Vox;

class View {
	private static $_instance = null;
	private $__viewPath = null;
	private $__viewDir = null;
	private $__extension = '.php';
	private $data = array();

	private function __construct() {
		$this->__viewPath = \Vox\App::getInstance()->getConfig()->app['viewsDirectory'];

		if ($this->__viewPath == null) {
			$this->__viewPath = realpath('../views/');
		}
	}

	public function setViewDirectory($path) {
		$path = trim($path);

		if ($path) {
			$path = realpath($path) . DIRECTORY_SEPARATOR;

			if (is_dir($path) && is_readable($path)) {
				$this->__viewDir = $path;
			} else {
				throw new \Exception('view path', 500);
			}
		} else {
			throw new \Exception('view path', 500);
		}
	}

	public function display($name, $data = array(), $returnAsString = false) {
		if (is_array($data)) {
			$this->data = array_merge($this->data, $data);
		}

		if ($returnAsString) {
			return $this->_includeFile($name);
		} else {
			echo $this->_includeFile($name);
		}
	}

	private function _includeFile($___file) {
		if ($this->__viewDir == null) {
			$this->setViewDirectory($this->__viewPath);
		}

		$___fl = $this->__viewDir . (str_replace('.', DIRECTORY_SEPARATOR, $___file)) . $this->__extension;

		if (file_exists($___fl) && is_readable($___fl)) {
			ob_start();
			include $___fl;
			return ob_get_clean();
		} else {
			throw new \Exception('View ' . $___file . ' cannot be included', 500);
		}
	}

	public function __set($name, $value) {
		$this->data[$name] = $value;
	}

	public function __get($name) {
		return $this->data[$name];
	}

	/**
	*
	* @return \Vox\View
	*/
	public static function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new \Vox\View();
		}

		return self::$_instance;
	}
}