<?php

namespace Controllers;

class Song extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();
		$songs = $songModel->getAll();

		$id = $this->input->post("action");
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $songModel->likeSong(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$songs = $songModel->getAll();
				$this->view->songs = $songs;
			}
		}

		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'songs');
		$this->view->display('layouts.themesbase');
	}

	public function upload() {
		$songModel = new \Models\SongModel();
		$songname = $this->input->post("name");
		$id = $this->input->post("songid");
		$artist = $this->input->post("artist");
		$album = $this->input->post("album");
		$genre = $this->input->post("genre");
		$user_id = 0;
		$genre_id = 0;

		if (isset($songname) && isset($id)) {
			if ($this->app->getSession()->userId) {
				$user_id = $this->app->getSession()->userId;
			}

			$genreModel = new \Models\GenreModel();
			$response = $genreModel->getByName($genre);

			if ($response[0]['id']) {
				$genre_id = $response[0]['id'];
			} else {
				$response = $genreModel->create($genre);
				if ($response != 0) {
					$response = $genreModel->getByName($genre);
					$genre_id = $response[0]['id'];
				}
			}

			$response = $songModel->create($songname, $artist, $album, $genre_id, $user_id, $id);

			if ($response != 0) {
				$this->app->getSession()->notyVal = '1Song Created|';
				header('Location: /vox/voxApplication/public/index.php/songs');
			} else {
				$this->view->notyVal = '0Error uploading song|';
			}
		}

		$this->view->appendToLayout('body', 'uploadsong');
		$this->view->display('layouts.themesbase');
	}

	public function listMySongs() {
		$songModel = new \Models\SongModel();
		$songs = $songModel->getUserSongs($this->app->getSession()->username);


		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'songs');
		$this->view->display('layouts.themesbase');
	}

	public function info() {
		$songModel = new \Models\SongModel();
		$songId = $this->input->get(0);
		$songId = intval($songId);

		if (isset($songId)) {
			$this->view->song = $songModel->getById($songId);

			if ($this->view->song) {
				$this->view->comments = $songModel->getSongComments($songId);				
			}
		}

		$id = $this->input->post("action");
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $songModel->likeSong(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$this->view->song = $songModel->getById($songId);
			}
		}

		$comment = $this->input->post("comment");

		if (isset($comment) && $this->app->getSession()->userId) {
			$response = $songModel->publishComment($songId, intval($this->app->getSession()->userId), $comment);

			if ($response != 0) {
				$this->view->notyVal = '1Comment Published|';
				$this->view->comments = $songModel->getSongComments($songId);
			} else {
				$this->view->notyVal = '0Error submiting comment|';
			}
		}

		$this->view->appendToLayout('body', 'songinfo');
		$this->view->display('layouts.themesbase');
	}
}