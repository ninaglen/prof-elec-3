<?php

define('DB_SERVER', 'gogrowglow-server.mysql.database.azure.com');
define('DB_USERNAME', 'miisndynxdp@gogrowglow-server');
define('DB_PASSWORD', 'coolkid03*'); 
define('DB_NAME', 'food_db');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
