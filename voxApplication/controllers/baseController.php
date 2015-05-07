<?php

namespace Controllers;

class BaseController extends \Vox\DefaultController {
	public function __construct() {
		parent::__construct();
		$this->view->isLoggedIn = $this->app->getSession()->isLoggedIn;
		$this->view->username = $this->app->getSession()->username;
	}
}