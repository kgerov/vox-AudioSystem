<?php

namespace Controllers;

class Profile extends \Controllers\BaseController {
	public function index() {
		$userModel = new \Models\UserModel();
		$currUser = $userModel->getByUsername($this->app->getSession()->username);
		
		// Enter new email
		$email = $this->input->post("email");
		if (isset($email)) {
			$response = $userModel->edit($this->app->getSession()->username, $email);

			if ($response != 0) {
				$this->app->getSession()->notyVal = '1Email updated|';
				header('Location: /index.php/songs');
				exit;
			} else {
				$this->view->notyVal = '0Update Failed|';
			}
		}

		// Change password
		$pass1 = $this->input->post("oldPass");
		$pass2 = $this->input->post("newPass");
		if (isset($pass1) && isset($pass2)) {
			$responsePass = $userModel->changePass($this->app->getSession()->username, md5($pass2), md5($pass1));

			if ($responsePass != 0) {
				$this->app->getSession()->notyVal = '1Pass changed|';
				header('Location: /index.php/songs');
				exit;
			} else {
				$this->view->notyVal = '0Incorrect old password|';
			}
		}

		$this->view->username = $currUser[0]['username'];
		$this->view->email = $currUser[0]['email'];
		$this->view->appendToLayout('body', 'profile');
		$this->view->display('layouts.skeletonLayout');
	}
}