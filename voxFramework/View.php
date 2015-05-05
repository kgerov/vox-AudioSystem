<?php

namespace Vox;

class View {
	private static $_instance = null;
	private $viewPath = null;
	private $viewDir = null;
	private $extension = '.php';
	private $data = array();

	private function __construct() {
		$this->viewPath = \Vox\App::getInstance()->getConfig()->app['viewsDirectory'];

		if ($this->viewPath == null) {
			$this->viewPath = realpath('../views/');
		}
	}

	public function setViewDirectory($path) {
		$path = trim($path);

		if ($path) {
			$path = realpath($path) . DIRECTORY_SEPARATOR;

			if (is_dir($path) && is_readable($path)) {
				$this->viewDir = $path;
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

	private function _includeFile($file) {
		if ($this->viewDir == null) {
			$this->setViewDirectory($this->viewPath);
		}

		$p = str_replace('.', DIRECTORY_SEPARATOR, $file);
		$fl = $this->viewDir . $p . $this->extension;

		if (file_exists($fl) && is_readable($fl)) {
			ob_start();
			include $fl;
			return ob_get_clean();
		} else {
			throw new \Exception('View ' . $file . ' cannot be included', 500);
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