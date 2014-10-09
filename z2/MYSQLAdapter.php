<?php namespace IIA;

use IIA\DbConnect as DbConnect;

class MYSQLAdapter extends DbConnect{
	private $mysqli = null;
	public function __construct($type, $host, $username, $password, $db_name) {
		parent::__construct($type, $host, $username, $password, $db_name);
		$this->initConnection();
	}

	private function initConnection() {
		$this->mysqli = mysqli_connect($this->host,$this->username,$this->password,$this->db_name);
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	public function findAll($table) {
		return $this->mysqli->query("SELECT * FROM ".$table);
	}
}