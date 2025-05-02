<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    header('Location: index.php');
    exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    if (empty($_POST['ph_level']) || empty($_POST['nitrogen_level']) || empty($_POST['phosphorus_level']) || 
        empty($_POST['potassium_level']) || empty($_POST['organic_matter']) || empty($_POST['soil_type']) || 
        empty($_POST['location'])) {
        $error = "Please fill in all required fields.";
    } else {
        try {
            // Sanitize input
            $ph_level = sanitize_input($_POST['ph_level']);
            $nitrogen_level = sanitize_input($_POST['nitrogen_level']);
            $phosphorus_level = sanitize_input($_POST['phosphorus_level']);
            $potassium_level = sanitize_input($_POST['potassium_level']);
            $organic_matter = sanitize_input($_POST['organic_matter']);
            $soil_type = sanitize_input($_POST['soil_type']);
            $location = sanitize_input($_POST['location']);
            $notes = isset($_POST['notes']) ? sanitize_input($_POST['notes']) : '';
            
            // Insert soil test data
            $stmt = $conn->prepare("INSERT INTO soil_tests (user_id, test_date, ph_level, nitrogen_level, phosphorus_level, 
                                potassium_level, organic_matter, soil_type, location, notes) 
                                VALUES (?, CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $_SESSION['user_id'],
                $ph_level,
                $nitrogen_level,
                $phosphorus_level,
                $potassium_level,
                $organic_matter,
                $soil_type,
                $location,
                $notes
            ]);
            
            if ($stmt->rowCount() > 0) {
                $success = "Soil test data has been successfully saved!";
                // Redirect to dashboard after successful submission
                header('Location: dashboard.php?success=' . urlencode($success));
                exit();
            } else {
                $error = "Failed to save soil test data. Please try again.";
            }
        } catch(PDOException $e) {
            error_log("Soil test error: " . $e->getMessage());
            $error = "Sorry, there was an error processing your soil test. Please try again later.";
        }
    }
}

// If there's an error, redirect back to the form with the error message
if (!empty($error)) {
    header('Location: dashboard1.php?error=' . urlencode($error));
    exit();
}
?> 