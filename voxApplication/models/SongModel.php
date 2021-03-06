<?php

namespace Models;

class SongModel extends \Models\BaseModel {	
	public function getAll() {
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
ORDER BY t1.id DESC
EOD;


		return self::$db->prepare($query)->execute()->fetchAllAssoc();
	}

    public function getAllByName($name) {
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
WHERE LOWER(t1.name) LIKE '%
EOD;
    
        $query .= $name . "%'";

        return self::$db->prepare($query)->execute()->fetchAllAssoc();
    }

    public function getWithPage($page, $userId) {
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
LEFT OUTER JOIN (
    SELECT s.id AS 'secId', COUNT(*) as 'upvotes'
    FROM songs s
    JOIN song_likes sl
    ON sl.song_id = s.id
    GROUP BY s.id) AS t2
ON t1.id = t2.secId
LEFT OUTER JOIN (
    SELECT songs.id as 'tid', COUNT(*) as 'hasLiked'
    FROM songs
    LEFT OUTER JOIN song_likes
    ON song_likes.song_id = songs.id
    WHERE song_likes.user_id = ?
    GROUP BY songs.id) AS t3
ON t1.id = t3.tid
ORDER BY t1.id DESC
LIMIT
EOD;
        $query .= " ". $page . ", 3";
        return self::$db->prepare($query)->execute(array($userId))->fetchAllAssoc();
    }

	public function getUserSongs($username) {
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
WHERE t1.username = ?
ORDER BY t1.id DESC
EOD;


		return self::$db->prepare($query)->execute(array($username))->fetchAllAssoc();
	}

    public function getById($id) {
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
WHERE t1.id = ?
EOD;

        return self::$db->prepare($query)->execute(array($id))->fetchAllAssoc();
    }

    public function getSongComments($id) {
        $query = <<<EOD
SELECT song_comments.id AS 'cid', song_comments.content, users.username
FROM songs
LEFT OUTER JOIN song_comments
ON song_comments.song_id = songs.id
LEFT OUTER JOIN users
ON song_comments.user_id = users.id
WHERE song_id = ?
EOD;

        return self::$db->prepare($query)->execute(array($id))->fetchAllAssoc();
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

    public function dislikeSong($userId, $songId) {
        $query = <<<EOD
DELETE FROM song_likes
WHERE user_id=? AND song_id=?
EOD;
        return self::$db->prepare($query)->execute(array($userId, $songId))->getAffectedRows();
    }

	public function getSongNames() {
		$query = <<<EOD
SELECT id, name 
FROM songs
ORDER BY id DESC
EOD;
		return self::$db->prepare($query)->execute()->fetchAllAssoc();
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

    public function publishComment($songId, $userId, $content) {
        $query = <<<EOD
INSERT INTO song_comments
(user_id, song_id, content)
VALUES(?,?,?)
EOD;
        return self::$db->prepare($query)->execute(array($userId, $songId, $content))->getAffectedRows();
    }

    public function deleteComment($id) {
        $query = <<<EOD
DELETE FROM song_comments
WHERE id=?
EOD;
        return self::$db->prepare($query)->execute(array($id))->getAffectedRows();
    }

    public function editComment($id, $content) {
        $query = <<<EOD
UPDATE song_comments
SET content=?
WHERE id=?
EOD;
        return self::$db->prepare($query)->execute(array($content, $id))->getAffectedRows();
    }

    public function getSongCount() {
        $query = <<<EOD
SELECT COUNT(*) AS 'pages'
FROM songs
EOD;
        return self::$db->prepare($query)->execute()->fetchAllAssoc();
    }

    public function delete($id) {
        $query = <<<EOD
DELETE FROM songs
WHERE id=?
EOD;
        return self::$db->prepare($query)->execute(array($id))->getAffectedRows();
    }

    public function edit($name, $artist, $album, $genre_id, $user_id) {

    }
}

// getWithPage Old
// SELECT * FROM (
//     SELECT s.id, s.name, artist, album, sc_id, u.username, g.name AS 'genre', GROUP_CONCAT(p.name SEPARATOR ',') AS 'playlists' FROM songs s
//     LEFT OUTER JOIN users u
//     ON s.user_id = u.id
//     LEFT OUTER JOIN genres g
//     ON s.genre_id = g.id
//     LEFT OUTER JOIN songplaylists sp
//     ON s.id = sp.song_id
//     LEFT OUTER JOIN playlists p
//     ON sp.playlist_id = p.id
//     GROUP BY s.name) AS t1
// LEFT OUTER JOIN (
//     SELECT s.id AS 'secId', COUNT(*) as 'upvotes'
//     FROM songs s
//     JOIN song_likes sl
//     ON sl.song_id = s.id
//     GROUP BY s.id) AS t2
// ON t1.id = t2.secId
// ORDER BY t1.id DESC