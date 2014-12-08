<?php

class MysqlDB {
    private $host;
    private $username;
    private $password;
    private $db_name;

    function __construct($db_name, $host, $username, $password)
    {
        $this->db_name = $db_name;
        $this->host = $host;
        $this->password = $password;
        $this->username = $username;

        $this->connect();
    }

    private function connect() {
        $this->mysqli = mysqli_connect($this->host,$this->username,$this->password,$this->db_name)
        or die('There was a problem connecting to mysql database - ' . mysqli_connect_error());

        $this->mysqli->set_charset("utf8");
    }

    public function insertInto($table, $columns) {
        $query = "INSERT into ".$table;
        $columnNames = array_keys($columns);
        $insertingWhat = "";
        $insertingValues = "";
        for($i = 0; $i < count($columns); $i++) {

            if($i == count($columns)-1) {
                $insertingWhat = $insertingWhat.$columnNames[$i];
                $insertingValues = $insertingValues."'".$columns[$columnNames[$i]]."'";
            } else {
                $insertingWhat = $insertingWhat.$columnNames[$i].", ";
                $insertingValues = $insertingValues."'".$columns[$columnNames[$i]]."', ";
            }
        }
        $query = $query." (".$insertingWhat.") VALUES (".$insertingValues.")";

        $this->mysqli->query($query);
        return $this->mysqli->insert_id;
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

    public function deleteById($table, $id) {
        $this->mysqli->query("DELETE FROM ".$table." WHERE id=".$id);
        return ($this->mysqli->affected_rows > 0) ? true : false;
    }

    public function close() {
        $this->mysqli->close();
    }
} 