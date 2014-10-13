<?php namespace IIA;


/**
 * Class MysqlMachine
 * @author Michal Gallovič
 * @package IIA
 */
class MysqlMachine {


    /**
     * Database credentials
     * @var string
     */
    private $host;
    private $username;
    private $password;
    private $db_name;


    /**
     * Mysql instance
     * @var mysqli
     */
    private $mysqli;

    function __construct($db_name, $host, $username, $password)
    {
        $this->db_name = $db_name;
        $this->host = $host;
        $this->password = $password;
        $this->username = $username;

        $this->connect();
    }


    /**
     * Connecting to database
     */
    private function connect() {
        $this->mysqli = mysqli_connect($this->host,$this->username,$this->password,$this->db_name)
        or die('There was a problem connecting to mysql database - ' . mysqli_connect_error());

        $this->mysqli->set_charset("utf8");
    }
    
    public function select($query) {
        $results_array = [];
        if($result = $this->mysqli->query($query)) {
            while($row = $result->fetch_object()) {
                array_push($results_array, $row);
            }

        }

        return $results_array;
    }

    public function findById($table,$id) {
        $result = $this->mysqli->query("SELECT * from " . $table . " where id=".$id);
        return $result->fetch_object();
    }



}