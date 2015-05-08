<?php

namespace Controllers;

class Playlist extends \Controllers\BaseController {
	public function index() {
		$playModel = new \Models\PlaylistModel();
		$playlists = $playModel->getAll();

		$id = $this->input->post("action"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playModel->likeSong(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$playlists = $playModel->getAll();
				$this->view->playlists = $playlists;
			}
		}

		$this->view->playlists = $playlists;

		$this->view->appendToLayout('body', 'playlists');

		$this->view->display('layouts.themesbase');
	}
}