<?php

namespace Controllers;

class Trending extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();
		$songs = $songModel->getTrending();

		$id = $this->input->post("action"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $songModel->likeSong(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$songs = $songModel->getTrending();
				$this->view->songs = $songs;
			}
		}

		$this->view->songs = $songs;

		$playModel = new \Models\PlaylistModel();
		$playlists = $playModel->getTrending();

		$id = $this->input->post("actionplay"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playModel->likePlaylist(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$playlists = $playModel->getTrending();
				$this->view->playlists = $playlists;
			}
		}

		$this->view->playlists = $playlists;

		$this->view->appendToLayout('body', 'songs');
		$this->view->appendToLayout('body2', 'playlists');

		$this->view->display('layouts.themesbase');
	}
}