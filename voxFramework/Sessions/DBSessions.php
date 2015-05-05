<?php


namespace Vox\Sessions;

class DBSessions extends \Vox\DB\SimpleDB implements \Vox\Sessions\ISession {
	private $sessionName;
	private $tableName;
	private $lifetime;
	private $path;
	private $domain;
	private $secure;
	private $sessionId;
	private $sessionData = array();

	public function __construct($dbconnection, $name, $tableName = 'sessions', $lifetime = 3600, $path = null, $domain = null, $secure = false) {
		parent::__construct($dbconnection);
		$this->sessionName = $name;
		$this->tableName = $tableName;
		$this->lifetime = $lifetime;
		$this->path = $path;
		$this->domain = $domain;
		$this->secure = $secure;
		$this->sessionId = $_COOKIE[$name];

		if (strlen($this->sessionId) < 32) {
			$this->_startNewSession();
		} else if (!$this->_validateSession()) {
			$this->_startNewSession();
		}
	}

	private function _startNewSession() {
		$this->sessionId = md5(uniqid('gf', TRUE));
		$this->prepare('INSERT INTO ' . $this->tableName . ' (sessid,valid_until) VALUES (?,?)',
			array($this->sessionId, (time() + $this->lifetime)))->execute();

		setcookie($this->sessionName, $this->sessionId, (time() + $this->lifetime), $this->path, $this->domain, $this->secure, true);
	}

	private function _validateSession() {
		if ($this->sessionId) {
			$d = $this->prepare('SELECT * FROM ' . $this->tableName . ' WHERE sessid=? AND valid_until<=?', 
				array($this->sessionId, (time() + $this->lifetime)))->execute()->fetchAllAssoc();

			if (is_array($d) && count($d) == 1 && $d[0]) {
				$this->sessionData = unserialize($d[0]['sess_data']);
				return true;
			}
		}

		return false;
	}

	public function getSessionId() {

	}

	public function saveSession() {
		if ($this->sessionId) {
			$this->prepare('UPDATE ' . $this->tableName . ' SET sess_data=?,valid_until=? WHERE sessid=?',
				array(serialize($this->sessionData), (time() + $this->lifetime), $this->session_id()))->execute();

			setcookie($this->sessionName, $this->sessionId, (time() + $this->lifetime), $this->path, $this->domain, $this->secure, true);
		}
	}

	public function destroySession() {

	}

	public function __get($name) {
		return $this->sessionData[$name];
	}

	public function __set($name, $value) {
		$this->sessionData[$name] = $value;
	}

}