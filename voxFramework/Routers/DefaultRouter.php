<?php

namespace Vox\Routers;

class DefaultRouter {
	public function parse() {
		$_uri = substr(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']), 1);
		$controller = null;
		$method = null;
		$_params = explode('/', $_uri);

		if ($_params[0]) {
			$controller = ucfirst($_params[0]);

			if ($_params[1]) {
				$method = $_params[1];
				unset($_params[0], $_params[1]);
			} else {
				$method = 'index';
			}
		} else {
			$controller = 'index';
			$method = 'index';
		}

		echo $controller . '<br>' . $method;
	}
}