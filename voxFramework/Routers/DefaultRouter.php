<?php

namespace Vox\Routers;

class DefaultRouter {
	public function getURI() {
		return substr($_SERVER['PHP_SELF'], strlen($_SERVER['SCRIPT_NAME']) + 1);
	}
}