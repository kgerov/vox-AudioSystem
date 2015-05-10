<?php

namespace Controllers;

class Trending extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();
		$playModel = new \Models\PlaylistModel();
		$songs = $songModel->getTrending();
		$playlists = $playModel->getTrending();

		// Like/Dislike Song
		$id = $this->input->post("action"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $songModel->likeSong(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$songs = $songModel->getTrending();
				$this->view->songs = $songs;
			}
		}

		// Like/Dislike playlist
		$id = $this->input->post("actionLike"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playModel->likePlaylist(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$playlists = $playModel->getTrending();
				$this->view->playlists = $playlists;
			}
		}

		$this->view->songs = $songs;
		$this->view->playlists = $playlists;
		$this->view->appendToLayout('body', 'songs.songs');
		$this->view->appendToLayout('body2', 'playlists.playlists');
		$this->view->display('layouts.skeletonLayout');
	}
}