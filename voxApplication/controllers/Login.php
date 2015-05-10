<?php

namespace Controllers;

class Login extends \Controllers\BaseController {
	public function index() {
		$userModel = new \Models\UserModel();
		$this->view->token = $this->app->getSession()->token;
		
		// Login
		$username = $this->input->post("username");
		$pass = $this->input->post("pass");
		$token = $this->input->post("token");

		if (isset($username) && isset($pass) && ($this->app->getSession()->token == $token)) {
			$response = $userModel->login($username, md5($pass));
			if ($response[0]['username']) {
				$this->app->getSession()->token = '';
				$this->app->getSession()->isLoggedIn = true;
				$this->app->getSession()->username = $response[0]['username'];
				$this->app->getSession()->userId = $response[0]['id'];
				$this->app->getSession()->isAdmin = $response[0]['isAdmin'];
				$this->app->getSession()->notyVal = '1Login successful|';

				header('Location: /index.php/songs');
				exit;
			} else {
				$this->view->notyVal = '0Invalid login|';
			}
		}

		// Register
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
					$this->app->getSession()->userId = $response;
					$this->app->getSession()->notyVal = '1Successful registration|';
					
					header('Location: /index.php/songs');
					exit;
				} else {
					$this->view->notyVal = '0Invalid registration|';
				}
			}
		}


		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.skeletonLayout');
	}
}