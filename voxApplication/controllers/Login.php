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


		$this->view->appendToLayout('body', 'login');
		$this->view->display('layouts.themesbase');
	}
}