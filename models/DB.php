<?php
$config = require(__DIR__ . '/../config.php');


class dbConnection {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct($config) {
        $this->host = $config['host'];
        $this->db_name = $config['db_name'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
          
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
// Instantiate the connection
$db = new dbConnection($config);
$conn = $db->getConnection();

?>


