<?php
// Helper functions

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function register_user($name, $email, $password, $farm_type) {
    global $conn;
    
    try {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            return "Email already exists";
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, farm_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $farm_type]);
        
        return true;
    } catch(PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

function login_user($email, $password) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                return true;
            }
        }
        return false;
    } catch(PDOException $e) {
        return false;
    }
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function logout() {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session cookie
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-3600, '/');
    }
    
    // Destroy the session
    session_destroy();
    
    // Redirect to home page
    header('Location: ../index.php');
    exit();
}

function get_user_data($user_id) {
    global $conn;
    
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return false;
    }
}
?> 