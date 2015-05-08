<?php

namespace Controllers;

class Playlist extends \Controllers\BaseController {
	public function index() {
		$playModel = new \Models\PlaylistModel();
		$playlists = $playModel->getAll();

		$id = $this->input->post("actionplay"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playModel->likePlaylist(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$playlists = $playModel->getAll();
				$this->view->playlists = $playlists;
			}
		}

		$this->view->playlists = $playlists;

		$this->view->appendToLayout('body', 'playlists');
		$this->view->display('layouts.themesbase');
	}

	public function create() {
		$songModel = new \Models\SongModel();
		$playlistModel = new \Models\PlaylistModel();

		$this->view->songs = $songModel->getSongNames();

		$playlistname = $this->input->post("name");
		$songs = $this->input->post("songs");

		if (isset($playlistname) && $this->app->getSession()->userId) {
			$newPlaylistId = $playlistModel->create($playlistname, intval($this->app->getSession()->userId));

			if ($newPlaylistId != 0) {
				if (count($songs) == 0) {
					$this->app->getSession()->notyVal = '1Playlist Created|';
					header('Location: /vox/voxApplication/public/index.php/playlists');
				} else {
					$songIds = array();

					foreach ($songs as $key => $value) {
						$songIds[] = intval($value);
					}

					$response = $playlistModel->addSongsToPlaylist(intval($newPlaylistId), $songIds);

					if ($response != 0) {
						$this->app->getSession()->notyVal = '1Playlist Created|';
						header('Location: /vox/voxApplication/public/index.php/playlists');
					} else {
						$this->view->notyVal = '0Error creating playlist|';
					}
				}
			} else {
				$this->view->notyVal = '0Error creating playlist|';
			}
		}

		$this->view->appendToLayout('body', 'createplaylist');
		$this->view->display('layouts.themesbase');
	}

	public function listMyPlaylists() {
		$playModel = new \Models\PlaylistModel();
		$playlists = $playModel->getUserPlaylists($this->app->getSession()->username);

		$this->view->playlists = $playlists;
		$this->view->appendToLayout('body', 'playlists');
		$this->view->display('layouts.themesbase');
	}

	public function info() {
		$playlistModel = new \Models\PlaylistModel();
		$playlistId = $this->input->get(0);
		$playlistId = intval($playlistId);

		if (isset($playlistId)) {
			$this->view->playlist = $playlistModel->getById($playlistId);

			if ($this->view->playlist) {
				$this->view->comments = $playlistModel->getPlaylistComments($playlistId);
				$this->view->songs = $playlistModel->getPlaylistSongs($playlistId);
			}
		}

		$id = $this->input->post("actionplay");
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playlistModel->likePlaylist(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$this->view->playlist = $playlistModel->getById($playlistId);
			}
		}

		$comment = $this->input->post("comment");

		if (isset($comment) && $this->app->getSession()->userId) {
			$response = $playlistModel->publishComment($playlistId, intval($this->app->getSession()->userId), $comment);

			if ($response != 0) {
				$this->view->notyVal = '1Comment Published|';
				$this->view->comments = $playlistModel->getPlaylistComments($playlistId);
			} else {
				$this->view->notyVal = '0Error submiting comment|';
			}
		}

		$this->view->appendToLayout('body', 'playlistInfo');
		$this->view->display('layouts.themesbase');
	}
}