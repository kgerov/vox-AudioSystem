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

	public function getAll() {
		$query = <<<EOD
SELECT genres.name, GROUP_CONCAT(songs.name SEPARATOR ',') AS 'songs'
FROM genres
LEFT OUTER JOIN songs
ON songs.genre_id = genres.id
GROUP BY genres.id
ORDER BY genres.id DESC
EOD;
		return self::$db->prepare($query)->execute(array($name))->fetchAllAssoc();
	}
}