<?php

namespace Models;

class SongModel extends \Models\BaseModel {	
	public function getAll() {
		$query = <<<EOD
SELECT s.id, s.name, artist, album, sc_id, u.username, g.name AS 'genre', s.upvotes, GROUP_CONCAT(p.name SEPARATOR ',') AS 'playlists' FROM songs s
LEFT OUTER JOIN users u
ON s.user_id = u.id
LEFT OUTER JOIN genres g
ON s.genre_id = g.id
LEFT OUTER JOIN songplaylists sp
ON s.id = sp.song_id
LEFT OUTER JOIN playlists p
ON sp.playlist_id = p.id
GROUP BY s.name
EOD;
		return self::$db->prepare($query)->execute()->fetchAllAssoc();
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

// SELECT s.id, s.name, artist, album, u.username, g.name AS 'genre', upvotes FROM songs s
// LEFT OUTER JOIN users u
// ON s.user_id = u.id
// LEFT OUTER JOIN genres g
// ON s.genre_id = g.id