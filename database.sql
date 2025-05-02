-- Create database
CREATE DATABASE IF NOT EXISTS soil_testing;
USE soil_testing;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    farm_type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Soil tests table
CREATE TABLE IF NOT EXISTS soil_tests (
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
);

-- Recommendations table
CREATE TABLE IF NOT EXISTS recommendations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    soil_test_id INT NOT NULL,
    fertilizer_type VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    application_method TEXT,
    timing VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (soil_test_id) REFERENCES soil_tests(id)
); 