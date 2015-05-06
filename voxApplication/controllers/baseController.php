<?php

namespace Controllers;

class BaseController extends \Vox\DefaultController {
	public function __construct() {
		parent::__construct();
		$this->view->loggedIn = true;
	}
}