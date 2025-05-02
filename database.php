<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'soil_testing');

// Create database connection
try {
    // First try to connect without database
    $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if database exists
    $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
    
    if ($result->rowCount() == 0) {
        // Database doesn't exist, redirect to setup
        if (basename($_SERVER['PHP_SELF']) != 'setup.php') {
            header('Location: setup.php');
            exit();
        }
    } else {
        // Database exists, connect to it
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch(PDOException $e) {
    // If we're not on the setup page, redirect to setup
    if (basename($_SERVER['PHP_SELF']) != 'setup.php') {
        header('Location: setup.php');
        exit();
    }
}
?> 