<?php

namespace Controllers;

class Song extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();
		$songs = $songModel->getAll();

		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'songs');
		$this->view->display('layouts.themesbase');

		$ab = $this->input->post("user");
		if (isset($ab)) {
			echo "<h1>" . $ab . "</h1>"; 
		}
	}
}