<?php

namespace Controllers;

class Logout extends \Controllers\BaseController {
	public function index() {
		$this->app->getSession()->destroySession();
		
		header('Location: /index.php/songs');
		exit;
	}
}