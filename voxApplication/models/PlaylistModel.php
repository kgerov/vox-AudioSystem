<?php

namespace Models;

class PlaylistModel extends \Models\BaseModel {	
	public function getAll() {
		$query = <<<EOD
SELECT * FROM (
    SELECT playlists.id, playlists.name, users.username, COUNT(playlist_likes.playlist_id) as 'upvotes'
FROM playlists
LEFT OUTER JOIN users
ON users.id = playlists.id
LEFT OUTER JOIN playlist_likes
ON playlist_likes.playlist_id = playlists.id
GROUP BY playlists.id) AS t1
JOIN (
    SELECT playlists.id, GROUP_CONCAT(songs.name SEPARATOR ',') AS 'songs'
	FROM playlists
	LEFT OUTER JOIN songplaylists
	ON songplaylists.playlist_id = playlists.id
	LEFT OUTER JOIN songs
	ON songs.id = songplaylists.song_id
	GROUP BY playlists.id) AS t2
ON t1.id = t2.id
ORDER BY t1.id DESC
EOD;

		return self::$db->prepare($query)->execute()->fetchAllAssoc();
	}

	public function create($name, $artist, $album, $genre_id, $user_id, $sc_id) {
		$query = <<<EOD
INSERT INTO songs
(name, artist, album, genre_id, user_id, sc_id)
VALUES(?,?,?,?,?,?)
EOD;
		return self::$db->prepare($query)->execute(array($name, $artist, $album, $genre_id, $user_id, $sc_id))->getAffectedRows();
	}

	public function likeSong($userId, $songId) {
		$query = <<<EOD
INSERT INTO song_likes
(user_id, song_id)
VALUES(?,?)
EOD;
		return self::$db->prepare($query)->execute(array($userId, $songId))->getAffectedRows();
	}

	public function delete($id) {

	}

	public function getById($id) {

	}

	public function edit($name, $artist, $album, $genre_id, $user_id) {

	}

	public function getTrending() {
		$query = <<<EOD
SELECT * FROM (
    SELECT s.id, s.name, artist, album, sc_id, u.username, g.name AS 'genre', GROUP_CONCAT(p.name SEPARATOR ',') AS 'playlists' FROM songs s
    LEFT OUTER JOIN users u
    ON s.user_id = u.id
    LEFT OUTER JOIN genres g
    ON s.genre_id = g.id
    LEFT OUTER JOIN songplaylists sp
    ON s.id = sp.song_id
    LEFT OUTER JOIN playlists p
    ON sp.playlist_id = p.id
    GROUP BY s.name) AS t1
JOIN (
    SELECT s.id, COUNT(*) as 'upvotes'
    FROM songs s
    LEFT OUTER JOIN song_likes sl
    ON sl.song_id = s.id
    GROUP BY s.id) AS t2
ON t1.id = t2.id
ORDER BY t2.upvotes DESC
LIMIT 0, 3
EOD;


		return self::$db->prepare($query)->execute()->fetchAllAssoc();
	}
}