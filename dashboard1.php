<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

// Check if user is logged in
if (!is_logged_in()) {
    header('Location: index.php');
    exit();
}

$isLoggedIn = true; // Since we're logged in
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soil Testing - Soil Testing & Fertilizer Recommendation System</title>
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
                    <a href="dashboard.php" class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">Dashboard</a>
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
                <a href="dashboard.php" class="w-full text-left bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">Dashboard</a>
                <a href="auth/logout.php" class="w-full text-left bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium mt-2">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Soil Testing Form -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Soil Testing Form</h2>
                <p class="mt-4 text-lg text-gray-600">Enter your soil test results to get personalized fertilizer recommendations.</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($_GET['error']); ?></span>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($_GET['success']); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white p-8 rounded-lg shadow-lg">
                <form action="process_soil_test.php" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="ph_level" class="block text-sm font-medium text-gray-700">pH Level</label>
                            <input type="number" step="0.1" id="ph_level" name="ph_level" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter pH level (0-14)">
                        </div>

                        <div>
                            <label for="nitrogen_level" class="block text-sm font-medium text-gray-700">Nitrogen Level (ppm)</label>
                            <input type="number" step="0.1" id="nitrogen_level" name="nitrogen_level" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter nitrogen level">
                        </div>

                        <div>
                            <label for="phosphorus_level" class="block text-sm font-medium text-gray-700">Phosphorus Level (ppm)</label>
                            <input type="number" step="0.1" id="phosphorus_level" name="phosphorus_level" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter phosphorus level">
                        </div>

                        <div>
                            <label for="potassium_level" class="block text-sm font-medium text-gray-700">Potassium Level (ppm)</label>
                            <input type="number" step="0.1" id="potassium_level" name="potassium_level" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter potassium level">
                        </div>

                        <div>
                            <label for="organic_matter" class="block text-sm font-medium text-gray-700">Organic Matter (%)</label>
                            <input type="number" step="0.1" id="organic_matter" name="organic_matter" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter organic matter percentage">
                        </div>

                        <div>
                            <label for="soil_type" class="block text-sm font-medium text-gray-700">Soil Type</label>
                            <select id="soil_type" name="soil_type" required
                                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                                <option value="">Select soil type</option>
                                <option value="sandy">Sandy</option>
                                <option value="clay">Clay</option>
                                <option value="loam">Loam</option>
                                <option value="silt">Silt</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" id="location" name="location" required
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Enter location">
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Additional Notes</label>
                        <textarea id="notes" name="notes" rows="4"
                                  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                  placeholder="Enter any additional notes about the soil test"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Submit Soil Test
                    </button>
                </form>
            </div>
        </div>
    </section>

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