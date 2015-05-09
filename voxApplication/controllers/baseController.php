<?php

namespace Controllers;

class BaseController extends \Vox\DefaultController {
	public function __construct() {
		parent::__construct();
		$this->view->isLoggedIn = $this->app->getSession()->isLoggedIn;
		$this->view->username = $this->app->getSession()->username;
		$this->view->notyVal = $this->app->getSession()->notyVal;
		$this->view->isAdmin = $this->app->getSession()->isAdmin;
		if (!$this->app->getSession()->token) {
			$this->app->getSession()->token = uniqid(mt_rand(), true);
		}
	}
}