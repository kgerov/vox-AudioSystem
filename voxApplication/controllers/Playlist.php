<?php

namespace Controllers;

class Playlist extends \Controllers\BaseController {
	public function index() {
		$playModel = new \Models\PlaylistModel();
		$this->getPage($playModel);	

		$playlists = $playModel->getWithPage((intval($this->view->currPage)-1)*5);

		// Like/Dislike Playlist
		$id = $this->input->post("actionLike"); 
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playModel->likePlaylist(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$playlists = $playModel->getWithPage((intval($this->view->currPage)-1)*5);
			}
		}


		$this->view->playlists = $playlists;
		$this->view->appendToLayout('body', 'playlists.playlists');
		$this->view->display('layouts.skeletonLayout');
	}

	public function create() {
		$songModel = new \Models\SongModel();
		$playlistModel = new \Models\PlaylistModel();

		// Create Playlist
		$playlistname = $this->input->post("name");
		$songs = $this->input->post("songs");

		if (isset($playlistname) && $this->app->getSession()->userId) {
			$newPlaylistId = $playlistModel->create($playlistname, intval($this->app->getSession()->userId));

			if ($newPlaylistId != 0) {
				if (count($songs) == 0) {
					$this->app->getSession()->notyVal = '1Playlist Created|';
					header('Location: /index.php/playlists');
				} else {
					$songIds = array();
					foreach ($songs as $key => $value) {
						$songIds[] = intval($value);
					}

					$response = $playlistModel->addSongsToPlaylist(intval($newPlaylistId), $songIds);
					if ($response != 0) {
						$this->app->getSession()->notyVal = '1Playlist Created|';
						header('Location: /index.php/playlists');
					} else {
						$this->view->notyVal = '0Error adding songs to playlist|';
					}
				}
			} else {
				$this->view->notyVal = '0Error creating playlist|';
			}
		}

		$this->view->songs = $songModel->getSongNames();
		$this->view->appendToLayout('body', 'playlists.createplaylist');
		$this->view->display('layouts.skeletonLayout');
	}

	public function listMyPlaylists() {
		$playModel = new \Models\PlaylistModel();
		$playlists = $playModel->getUserPlaylists($this->app->getSession()->username);

		$this->view->playlists = $playlists;
		$this->view->appendToLayout('body', 'playlists.playlists');
		$this->view->display('layouts.skeletonLayout');
	}

	public function info() {
		$playlistModel = new \Models\PlaylistModel();
		$playlistId = intval($this->input->get(0));

		// Get playlist info, songs, comments
		if (isset($playlistId)) {
			$this->view->playlist = $playlistModel->getById($playlistId);

			if ($this->view->playlist) {
				$this->view->comments = $playlistModel->getPlaylistComments($playlistId);
				$this->view->songs = $playlistModel->getPlaylistSongs($playlistId);
			}
		}

		// Like/Dislike playlist
		$id = $this->input->post("actionLike");
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $playlistModel->likePlaylist(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$this->view->playlist = $playlistModel->getById($playlistId);
			}
		}

		// Comment on playlist
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

		$this->view->appendToLayout('body', 'playlists.playlistInfo');
		$this->view->display('layouts.skeletonLayout');
	}

	private function getPage($playModel) {
		$pages = intval($playModel->getPlaylistCount()[0]['pages']);
		$this->view->pages = ($pages%5 == 0 ? $pages/5 : $pages/5+1);

		if (intval($this->input->get(0)) >= 1) {
			$this->view->currPage = intval($this->input->get(0));
		} else {
			$this->view->currPage = 1;
		}
	}
}