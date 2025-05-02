<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

$isLoggedIn = isset($_SESSION['user_id']);
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
        $error = "Please fill in all required fields.";
    } else {
        $name = sanitize_input($_POST['name']);
        $email = sanitize_input($_POST['email']);
        $subject = sanitize_input($_POST['subject']);
        $message = sanitize_input($_POST['message']);
        
        try {
            // Check if database connection exists
            if (!isset($conn) || !$conn) {
                throw new PDOException("Database connection not established");
            }
            
            $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            3
            if ($stmt->rowCount() > 0) {
                $success = "Thank you for your message! We'll get back to you soon.";
            } else {
                $error = "Failed to save your message. Please try again.";
            }
        } catch(PDOException $e) {
            error_log("Contact form error: " . $e->getMessage());
            $error = "Sorry, there was an error sending your message. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Soil Testing & Fertilizer Recommendation System</title>
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
                    <a href="contact.php" class="text-primary px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    <?php if (!$isLoggedIn): ?>
                        <button class="bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium" id="loginBtn">Login</button>
                        <button class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium" id="registerBtn">Register</button>
                    <?php else: ?>
                        <a href="dashboard.php" class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="auth/logout.php" class="bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium">Logout</a>
                    <?php endif; ?>
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
                <a href="contact.php" class="text-primary block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                <?php if (!$isLoggedIn): ?>
                    <button class="w-full text-left bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium" id="mobileLoginBtn">Login</button>
                    <button class="w-full text-left bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium mt-2" id="mobileRegisterBtn">Register</button>
                <?php else: ?>
                    <a href="dashboard.php" class="w-full text-left bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="auth/logout.php" class="w-full text-left bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium mt-2">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Contact Us</h2>
                <p class="mt-4 text-lg text-gray-600">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>

            <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo $success; ?></span>
                </div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline"><?php echo $error; ?></span>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <form action="contact.php" method="POST" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="name" name="name" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter your full name">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter your email">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                            <input type="text" id="subject" name="subject" required
                                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                   placeholder="Enter the subject">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="4" required
                                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                      placeholder="Enter your message"></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Get in Touch</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-primary text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Address</h4>
                                <p class="mt-1 text-gray-600">123 Farm Lane, Agriculture City, CA 90210</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-phone text-primary text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Phone</h4>
                                <p class="mt-1 text-gray-600">+1 (800) 123-4567</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-envelope text-primary text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Email</h4>
                                <p class="mt-1 text-gray-600">info@soilhealth.com</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-primary text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Working Hours</h4>
                                <p class="mt-1 text-gray-600">Monday - Friday: 9:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-gray-600 hover:text-primary">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Auth Modals -->
    <?php if (!$isLoggedIn): ?>
        <?php include 'includes/login-modal.php'; ?>
        <?php include 'includes/register-modal.php'; ?>
    <?php endif; ?>

    <script>
        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Modal handling
        const loginBtn = document.getElementById('loginBtn');
        const registerBtn = document.getElementById('registerBtn');
        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        const mobileRegisterBtn = document.getElementById('mobileRegisterBtn');
        const loginModal = document.getElementById('loginModal');
        const registerModal = document.getElementById('registerModal');
        const closeLoginModal = document.getElementById('closeLoginModal');
        const closeRegisterModal = document.getElementById('closeRegisterModal');

        function showModal(modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideModal(modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        loginBtn?.addEventListener('click', () => showModal(loginModal));
        registerBtn?.addEventListener('click', () => showModal(registerModal));
        mobileLoginBtn?.addEventListener('click', () => showModal(loginModal));
        mobileRegisterBtn?.addEventListener('click', () => showModal(registerModal));
        closeLoginModal?.addEventListener('click', () => hideModal(loginModal));
        closeRegisterModal?.addEventListener('click', () => hideModal(registerModal));

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === loginModal) hideModal(loginModal);
            if (e.target === registerModal) hideModal(registerModal);
        });
    </script>
</body>
</html> 