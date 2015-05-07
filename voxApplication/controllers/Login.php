<?php

namespace Controllers;

class Login extends \Controllers\BaseController {
	public function index() {
		//$songModel = new \Models\SongModel();
		//$songs = $songModel->getAll();

		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.themesbase');
	}
}