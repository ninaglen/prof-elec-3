<?php
// Database configuration for Go, Grow, Glow Food Tracker
// Group 3 - Food Pyramid

define('DB_HOST', 'localhost');
define('DB_NAME', 'food_pyramid_db'); 
define('DB_USER', 'root');
define('DB_PASS', 'root'); 
define('DB_CHARSET', 'utf8mb4');

class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $charset = DB_CHARSET;
    public $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

// Create database connection instance
$database = new Database();
$db = $database->getConnection();

// Check connection
if (!$db) {
    die("Database connection failed. Please check your configuration.");
}
?>
