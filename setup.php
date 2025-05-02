<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Create connection without database
    $conn = new PDO("mysql:host=$host", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Drop database if exists (for fresh start)
    $sql = "DROP DATABASE IF EXISTS soil_testing";
    $conn->exec($sql);
    echo "Old database dropped (if existed)<br>";
    
    // Create database
    $sql = "CREATE DATABASE soil_testing";
    $conn->exec($sql);
    echo "Database created successfully<br>";
    
    // Select the database
    $conn->exec("USE soil_testing");
    
    // Create users table
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        farm_type VARCHAR(50) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Users table created successfully<br>";
    
    // Create soil_tests table
    $sql = "CREATE TABLE soil_tests (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        test_date DATE NOT NULL,
        ph_level DECIMAL(4,2),
        nitrogen_level DECIMAL(6,2),
        phosphorus_level DECIMAL(6,2),
        potassium_level DECIMAL(6,2),
        organic_matter DECIMAL(6,2),
        soil_type VARCHAR(50),
        location VARCHAR(255),
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $conn->exec($sql);
    echo "Soil tests table created successfully<br>";
    
    // Create recommendations table
    $sql = "CREATE TABLE recommendations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        soil_test_id INT NOT NULL,
        fertilizer_type VARCHAR(100) NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        application_method TEXT,
        timing VARCHAR(100),
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (soil_test_id) REFERENCES soil_tests(id)
    )";
    $conn->exec($sql);
    echo "Recommendations table created successfully<br>";
    
    // Create contact_messages table
    $sql = "CREATE TABLE contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(200) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Contact messages table created successfully<br>";
    
    // Create a test user
    $name = "Test User";
    $email = "test@example.com";
    $password = password_hash("test123", PASSWORD_DEFAULT);
    $farm_type = "crops";
    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, farm_type) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $farm_type]);
    echo "Test user created successfully<br>";
    
    echo "<br>Setup completed successfully!<br>";
    echo "<a href='index.php'>Go to Homepage</a>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    echo "<br><br>Please make sure:";
    echo "<br>1. XAMPP is running (both Apache and MySQL)";
    echo "<br>2. MySQL username is 'root' and password is empty (default XAMPP settings)";
    echo "<br>3. You have proper permissions to create databases";
}
?> 