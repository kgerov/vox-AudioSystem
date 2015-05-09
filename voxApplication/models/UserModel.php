<?php

namespace Models;

class UserModel extends \Models\BaseModel {	
	public function login($username, $pass) {
		$query = <<<EOD
SELECT id, username, isAdmin FROM users
WHERE username=? AND pass=?
EOD;
		return self::$db->prepare($query)->execute(array($username, $pass))->fetchAllAssoc();
	}

	public function register($username, $email, $pass) {
		$query = <<<EOD
INSERT INTO users
(username, pass, email)
VALUES(?,?,?)
EOD;
		return self::$db->prepare($query)->execute(array($username, $pass, $email))->getLastInsertId();
	}

	public function delete($id) {

	}

	public function getById($id) {

	}

	public function getByUsername($username) {
		$query = <<<EOD
SELECT username, email FROM users
WHERE username=?
EOD;
		return self::$db->prepare($query)->execute(array($username))->fetchAllAssoc();
	}

	public function edit($username, $email) {
		$query = <<<EOD
UPDATE users
SET email=?
WHERE username=?
EOD;
		return self::$db->prepare($query)->execute(array($email, $username))->getAffectedRows();
	}

		public function changePass($username, $passNew, $passOld) {
		$query = <<<EOD
UPDATE users
SET pass=?
WHERE username=? && pass=?
EOD;
		return self::$db->prepare($query)->execute(array($passNew, $username, $passOld))->getAffectedRows();
	}
}