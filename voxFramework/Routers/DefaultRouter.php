<?php

namespace Vox\Routers;

class DefaultRouter {
	public function parse() {
		$_uri = substr(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']), 1);
		echo $_uri;
	}
}