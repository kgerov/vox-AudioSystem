<?php

namespace Models;

class GenreModel extends \Models\BaseModel {	
	public function getByName($name) {
		$query = <<<EOD
SELECT id, name FROM genres
WHERE name=?
EOD;
		return self::$db->prepare($query)->execute(array($name))->fetchAllAssoc();
	}

	public function create($name) {
		$query = <<<EOD
INSERT INTO genres
(name)
VALUES(?)
EOD;
		return self::$db->prepare($query)->execute(array($name))->getAffectedRows();
	}
}