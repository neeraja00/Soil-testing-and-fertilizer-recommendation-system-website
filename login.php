<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitize_input($_POST['email']);
    $password = $_POST['password'];
    
    if (login_user($email, $password)) {
        $_SESSION['success'] = "Login successful!";
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password";
        header('Location: ../index.php');
        exit();
    }
}
?> 