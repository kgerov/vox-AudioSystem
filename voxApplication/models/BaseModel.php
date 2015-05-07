<?php

namespace Models;

abstract class BaseModel {
	protected static $db = null;

	public function __construct() {
		if (self::$db == null) {
			self::$db = new \Vox\DB\SimpleDB();
		}
	}
}