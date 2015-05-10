<?php

namespace Controllers;

class Genres extends \Controllers\BaseController {
	public function index() {
		$genreModel = new \Models\GenreModel();
		$genres = $genreModel->getAll();

		// Create Genre
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

		// Delete Genre
		$nameDelete = $this->input->post("actionDelete"); 
		if (isset($nameDelete) && $this->app->getSession()->userId) {
			$response = $genreModel->delete($nameDelete);

			if ($response != 0) {
				$this->view->notyVal = '1Delete Successful|';
				$genres = $genreModel->getAll();
			} else {
				$this->view->notyVal = '0Could not delete genre|';
			}
		}

		// Edit Genre
		$nameEdit = $this->input->post("actionEdit");
		$newname = $this->input->post("newName");
		if (isset($nameEdit) && $this->app->getSession()->userId) {
			$response = $genreModel->edit($nameEdit, $newname);

			if ($response != 0) {
				$this->view->notyVal = '1Edit Successful|';
				$genres = $genreModel->getAll();
			} else {
				$this->view->notyVal = '0Could not edit genre|';
			}
		}

		$this->view->genres = $genres;
		$this->view->appendToLayout('body', 'genres');
		$this->view->display('layouts.skeletonLayout');
	}
}