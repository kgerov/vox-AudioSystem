<?php

namespace Models;

class UserModel extends \Models\BaseModel {	
	public function login($username, $pass) {
		$query = <<<EOD
SELECT username FROM users
WHERE username=? AND pass=?
EOD;
		return self::$db->prepare($query)->execute(array($username, $pass))->fetchAllAssoc();
	}

	public function create($name, $artist, $album, $genre_id, $user_id, $sc_id) {

	}

	public function delete($id) {

	}

	public function getById($id) {

	}

	public function edit($name, $artist, $album, $genre_id, $user_id) {

	}
}