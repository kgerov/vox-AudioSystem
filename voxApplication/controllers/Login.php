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
				header('Location: /vox/voxApplication/public/index.php/songs');
				exit;
			} else {
				echo "<script>alert('Invalid login')</script>";
			}
		}


		$newUsername = $this->input->post("newUsername");
		$email = $this->input->post("email");
		$pass1 = $this->input->post("password");
		$pass2 = $this->input->post("passwordConfirm");

		if (isset($newUsername) && isset($email) && isset($pass1) && isset($pass2)) {
			if ($pass1 != $pass2) {
				echo "<script>alert('Passwords do not match')</script>";
			}

			$response = $userModel->register($newUsername, $email, md5($pass1));
			if ($response != 0) {
				$this->app->getSession()->isLoggedIn = true;
				$this->app->getSession()->username = $newUsername;
				header('Location: /vox/voxApplication/public/index.php/songs');
				exit;
			} else {
				echo "<script>alert('Invalid registration')</script>";
			}
		}


		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.themesbase');
	}
}