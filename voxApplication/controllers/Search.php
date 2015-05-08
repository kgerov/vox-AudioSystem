<?php

namespace Controllers;

class Search extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();

		$search = $this->input->post("search");
		if (isset($search)) {
			$this->view->songs = $songModel->getAllByName($search);

			if (count($this->view->songs) > 0) {
				$this->view->appendToLayout('body2', 'songs');
			} else {
				$this->view->appendToLayout('body2', 'errors.noresults');
			}
		}


		$this->view->appendToLayout('body', 'search');
		$this->view->display('layouts.themesbase');
	}
}