<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    header('Location: index.php');
    exit();
}

$isLoggedIn = true;
$success = isset($_GET['success']) ? $_GET['success'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';

// Fetch user's soil tests
try {
    $stmt = $conn->prepare("SELECT * FROM soil_tests WHERE user_id = ? ORDER BY test_date DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $soil_tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = "Error fetching soil tests: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Soil Testing & Fertilizer Recommendation System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4CAF50',
                        secondary: '#2E7D32',
                        accent: '#8BC34A',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo and Title -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS28gxPzJdFKyumSBAoMUUlHcwa8O8iBW2b-TcccCwViZ5p3MsWH3ap_UoqSuxdYO8l4xY&usqp=CAU" 
                             alt="Soil Testing Logo" 
                             class="h-12 w-12 rounded-full">
                        <span class="ml-3 text-xl font-semibold text-gray-800">Soil Testing System</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php#features" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Features</a>
                    <a href="analysis.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Analysis</a>
                    <a href="index.php#testimonials" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Testimonials</a>
                    <a href="contact.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    <a href="dashboard1.php" class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">New Test</a>
                    <a href="auth/logout.php" class="bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium">Logout</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 hover:text-primary focus:outline-none" id="hamburger">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="hidden md:hidden" id="mobileMenu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="index.php#features" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Features</a>
                <a href="analysis.php" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Analysis</a>
                <a href="index.php#testimonials" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Testimonials</a>
                <a href="contact.php" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                <a href="dashboard1.php" class="w-full text-left bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">New Test</a>
                <a href="auth/logout.php" class="w-full text-left bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium mt-2">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            <a href="dashboard1.php" class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">
                <i class="fas fa-plus mr-2"></i>New Soil Test
            </a>
        </div>

        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($success); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <!-- Soil Tests List -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Your Soil Tests</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">pH Level</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NPK Levels</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Soil Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($soil_tests)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No soil tests found. <a href="dashboard1.php" class="text-primary hover:text-secondary">Start a new test</a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($soil_tests as $test): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo date('M d, Y', strtotime($test['test_date'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo htmlspecialchars($test['location']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo htmlspecialchars($test['ph_level']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        N: <?php echo htmlspecialchars($test['nitrogen_level']); ?> ppm<br>
                                        P: <?php echo htmlspecialchars($test['phosphorus_level']); ?> ppm<br>
                                        K: <?php echo htmlspecialchars($test['potassium_level']); ?> ppm
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?php echo ucfirst(htmlspecialchars($test['soil_type'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <a href="view_test.php?id=<?php echo $test['id']; ?>" class="text-primary hover:text-secondary mr-3">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="delete_test.php?id=<?php echo $test['id']; ?>" class="text-red-600 hover:text-red-800" 
                                           onclick="return confirm('Are you sure you want to delete this test?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html> 