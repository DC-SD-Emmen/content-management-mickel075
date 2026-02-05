<?php
    /**
     * database.php
     * Bevat: Database (PDO connection), Game class, GameManager class
     *
     * Pas DB_HOST, DB_NAME, DB_USER, DB_PASS aan
     */

    class Database {

        //database connection details
        private $host = 'mysql';    // DB_HOST
        private $Database   = 'gamelibrary';  // DB_NAME
        private $user = 'root';         // DB_USER
        private $pass = 'root';         // DB_PASS
        private $charset = 'utf8mb4';
        public $conn;

        //construct method
        //use PDO
        //use try and catch
        //use public $conn
        public function __construct() {
            
            try {
                $dsn = "mysql:host=$this->host;dbname=$this->Database;charset=$this->charset";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }

        //get connection
        public function getConnection() {
            return $this->conn;
        }

    }

?>