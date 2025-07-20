<?php
// Secure Azure-compatible Database configuration for Go, Grow, Glow Food Tracker

$host = 'gp-grow-glow-tracker-server.mysql.database.azure.com';
$dbname = 'gp-grow-glow-tracker-database';
$username = 'lofcqmeihf';
$password = 'root123*'; // Replace with your actual password
$port = 3306; // Default MySQL port

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset = 'utf8mb4';
    private $port;
    public $conn;

    public function __construct($host, $db_name, $username, $password, $port = 3306) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset={$this->charset}";
            $this->conn = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }

        return $this->conn;
    }
}

// Create and connect
$database = new Database($host, $dbname, $username, $password, $port);
$db = $database->getConnection();

if (!$db) {
    die("Database connection failed. Please check your configuration.");
}
?>
