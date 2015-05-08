<?php

namespace Controllers;

class Login extends \Controllers\BaseController {
	public function index() {
		$userModel = new \Models\UserModel();
		
		$username = $this->input->post("username");
		$pass = $this->input->post("pass");

		if (isset($username) && isset($pass)) {
			$response = $userModel->login($username, md5($pass));
			if ($response[0]['username']) {
				$this->app->getSession()->isLoggedIn = true;
				$this->app->getSession()->username = $response[0]['username'];
				$this->app->getSession()->notyVal = '1Login successful|';
				header('Location: /vox/voxApplication/public/index.php/songs');
				exit;
			} else {
				$this->view->notyVal = '0Invalid login|';
			}
		}


		$newUsername = $this->input->post("newUsername");
		$email = $this->input->post("email");
		$pass1 = $this->input->post("password");
		$pass2 = $this->input->post("passwordConfirm");

		if (isset($newUsername) && isset($email) && isset($pass1) && isset($pass2)) {
			if ($pass1 != $pass2) {
				$this->view->notyVal = '0Passwords do not match|';
			}
			else {
				$response = $userModel->register($newUsername, $email, md5($pass1));
				if ($response != 0) {
					$this->app->getSession()->isLoggedIn = true;
					$this->app->getSession()->username = $newUsername;
					$this->app->getSession()->notyVal = '1Successful registration|';
					header('Location: /vox/voxApplication/public/index.php/songs');
					exit;
				} else {
					$this->view->notyVal = '0Invalid registration|';
				}
			}
		}


		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.themesbase');
	}
}