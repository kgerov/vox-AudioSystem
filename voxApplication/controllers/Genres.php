<?php

namespace Controllers;

class Genres extends \Controllers\BaseController {
	public function index() {
		$genreModel = new \Models\GenreModel();
		$genres = $genreModel->getAll();

		$name = $this->input->post("name");

		if (isset($name)) {
			$response = $genreModel->create($name);	

			if ($response != 0) {
				$this->view->notyVal = '1Genre Created|';
				$genres = $genreModel->getAll();
			} else {
				$this->view->notyVal = '0Could not create genre|';
			}
		}

		$this->view->genres = $genres;

		$this->view->appendToLayout('body', 'genres');
		$this->view->display('layouts.themesbase');
	}
}