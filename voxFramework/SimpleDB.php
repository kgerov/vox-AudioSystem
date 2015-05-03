<?php

namespace Vox\DB;

class SimpleDB {
	protected $connection = 'default';
	private $db = null;
	private $stmt = null;
	private $params = array();
	private $sql;

	public function __construct($connection = null) {
		if ($connection instanceof \PDO) {
			$this->connection = $connection;
		} else if($connection != null) {
			$this->db = \Vox\App::getInstance()->getDBConnection($connection);
			$this->connection = $connection;
		} else {
			$this->db = \Vox\App::getInstance()->getDBConnection($this->connection);
		}
	}

	/**
	*
	* @param type $sql
	* @param type $params
	* @param type $pdoOptions
	* @return \Vox\DB\SimpleDB
	*/

	public function prepare($sql, $params = array(), $pdoOptions = array()) {
		$this->stmt = $this->db->prepare($sql, $pdoOptions);
		$this->params = $params;
		$this->sql = $sql;

		return $this;
	}
}