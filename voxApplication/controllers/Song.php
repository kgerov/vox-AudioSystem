<?php

namespace Controllers;

class Song extends \Controllers\BaseController {
	public function index() {
		$songModel = new \Models\SongModel();
		$this->getPage($songModel);

		if ($this->app->getSession()->userId) {
			$userIdLike = $this->app->getSession()->userId;
		} else {
			$userIdLike = -1;
		}

		$songs = $songModel->getWithPage((intval($this->view->currPage)-1)*3, $userIdLike);

		// Like/Dislike song
		$id = $this->input->post("action");
		$hasLiked = $this->input->post("hasLiked");
		if (isset($id) && $this->app->getSession()->userId) {
			if ($hasLiked) {
				$response = $songModel->dislikeSong(intval($this->app->getSession()->userId), intval($id));
			} else {
				$response = $songModel->likeSong(intval($this->app->getSession()->userId), intval($id));
			}

			if ($response != 0) {
					$songs = $songModel->getWithPage((intval($this->view->currPage)-1)*3, $userIdLike);
					$this->view->songs = $songs;
				}
		}

		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'songs.songs');
		$this->view->display('layouts.skeletonLayout');
	}

	public function upload() {
		$songModel = new \Models\SongModel();

		// Upload song
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
				header('Location: /index.php/songs');
			} else {
				$this->view->notyVal = '0Error uploading song|';
			}
		}

		$this->view->appendToLayout('body', 'songs.uploadsong');
		$this->view->display('layouts.skeletonLayout');
	}

	public function listMySongs() {
		$songModel = new \Models\SongModel();
		$songs = $songModel->getUserSongs($this->app->getSession()->username);


		$this->view->songs = $songs;
		$this->view->appendToLayout('body', 'songs.songs');
		$this->view->display('layouts.skeletonLayout');
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

		// Like/Dislike song
		$id = $this->input->post("action");
		if (isset($id) && $this->app->getSession()->userId) {
			$response = $songModel->likeSong(intval($this->app->getSession()->userId), intval($id));

			if ($response != 0) {
				$this->view->song = $songModel->getById($songId);
			}
		}

		// Admin delete song
		$deleteId = $this->input->post("deleteAction");
		if (isset($deleteId) && ($this->app->getSession()->isAdmin == '1')) {
			$response = $songModel->delete(intval($deleteId));

			if ($response != 0) {
				$this->app->getSession()->notyVal = '1Song Deleted|';
				header('Location: /index.php/songs');
			} else {
				$this->view->notyVal = '0Error deleting song|';
			}
		}

		// Admin delete comment
		$deleteCommentId = $this->input->post("deleteCommentAction");
		if (isset($deleteCommentId) && ($this->app->getSession()->isAdmin == '1')) {
			$response = $songModel->deleteComment(intval($deleteCommentId));

			if ($response != 0) {
				$this->view->notyVal = '1Comment Deleted|';
				$this->view->comments = $songModel->getSongComments($songId);
			} else {
				$this->view->notyVal = '0Error deleting comment|';
			}
		}

		// Admin edit comment
		$editCommentId = $this->input->post("editCommentAction");
		$editedComment = $this->input->post("editedComment");
		if (isset($editCommentId) && ($this->app->getSession()->isAdmin == '1')) {
			$response = $songModel->editComment(intval($editCommentId), $editedComment);

			if ($response != 0) {
				$this->view->notyVal = '1Comment Edited|';
				$this->view->comments = $songModel->getSongComments($songId);
			} else {
				$this->view->notyVal = '0Error editing comment|';
			}
		}

		// User add new comment
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

		$this->view->appendToLayout('body', 'songs.songinfo');
		$this->view->display('layouts.skeletonLayout');
	}

	private function getPage($songModel) {
		$pages = intval($songModel->getSongCount()[0]['pages']);
		$this->view->pages = ($pages%3 == 0 ? $pages/3 : $pages/3+1);

		if (intval($this->input->get(0)) >= 1) {
			$this->view->currPage = intval($this->input->get(0));
		} else {
			$this->view->currPage = 1;
		}
	}
}