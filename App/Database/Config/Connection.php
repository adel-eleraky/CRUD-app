<?php 

namespace App\Database\Config;

class Connection {

    private $hostName = "localhost";
    private $hostUsername = "root";
    private $hostPassword = "";
    private $database = "crud";
    private $port = "3306";
    public \mysqli $connection;


    // open connection to database
    public function __construct()
    {
        $this->connection = new \mysqli($this->hostName , $this->hostUsername , $this->hostPassword , $this->database , $this->port);

        // Check connection
        // if ($this->connection->connect_error) {
        //     die("Connection failed: " . $this->conn->connect_error);
        // }
        // echo "Connected successfully";
    }

    // close connection to database
    public function __destruct()
    {
        $this->connection->close();
    }
}


?>