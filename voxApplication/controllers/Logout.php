<?php

namespace Controllers;

class Logout extends \Controllers\BaseController {
	public function index() {
		$this->app->getSession()->destroySession();
		$this->app->getSession()->notyVal = '1Logged out. Bye!|';
		header('Location: /vox/voxApplication/public/index.php/songs');
		exit;
	}
}