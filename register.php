<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $farm_type = sanitize_input($_POST['farm_type']);
    
    // Validate passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
        header('Location: ../index.php');
        exit();
    }
    
    // Register user
    $result = register_user($name, $email, $password, $farm_type);
    
    if ($result === true) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['error'] = $result;
        header('Location: ../index.php');
        exit();
    }
}
?> 