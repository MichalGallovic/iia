<?php namespace IIA;
require('MYSQLAdapter.php');

class DbConnect {
	protected $host;
	protected $username;
	protected $password;
	protected $db_name;
	private $type;

	public function __construct($type, $host, $username, $password, $db_name) {
		$this->type = $type;
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->db_name = $db_name;
	}

	public function getDbInstance() {
		$instance = null;
		switch ($this->type) {
			case 'mysql':
				$instance = new MYSQLAdapter($this->type,$this->host,$this->username,$this->password,$this->db_name);
				break;
			
			default:
				break;
		}

		return $instance;
	}
}