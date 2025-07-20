<?php
// Secure Azure-compatible Database configuration for Go, Grow, Glow Food Tracker

$host = 'gp-grow-glow-tracker-server.mysql.database.azure.com';
$dbname = 'gp-grow-glow-tracker-database';
$username = 'lofcqmeihf@gp-grow-glow-tracker-server'; // Must include @server for Azure
$password = 'root123*'; // Replace with actual password
$port = 3306;
$ssl_ca = __DIR__ . 'C:\phpsite\DigiCertGlobalRootG2.crt.pem'; // Adjust path as needed

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset = 'utf8mb4';
    private $port;
    private $ssl_ca;
    public $conn;

    public function __construct($host, $db_name, $username, $password, $port = 3306, $ssl_ca = null) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->ssl_ca = $ssl_ca;
    }

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset={$this->charset}";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            if ($this->ssl_ca && file_exists($this->ssl_ca)) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = $this->ssl_ca;
            }

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }

        return $this->conn;
    }
}

// Connect securely
$database = new Database($host, $dbname, $username, $password, $port, $ssl_ca);
$db = $database->getConnection();

if (!$db) {
    die("Database connection failed. Please check your configuration.");
}
?>
