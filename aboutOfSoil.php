<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Soil | Soil Testing & Fertilizer Recommendation System</title>
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
                    <a href="index.php#testimonials" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Testimonials</a>
                    <a href="contact.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    <a href="analysis.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Analysis</a>
                    <a href="dashboard1.php" class="text-gray-600 hover:text-primary px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <?php if ($isLoggedIn): ?>
                        <a href="dashboard1.php" class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">New Test</a>
                        <a href="auth/logout.php" class="bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium">Logout</a>
                    <?php else: ?>
                        <a href="auth/login.php" class="bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="auth/register.php" class="bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
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
                <a href="index.php#testimonials" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Testimonials</a>
                <a href="contact.php" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                <a href="analysis.php" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Analysis</a>
                <a href="dashboard1.php" class="text-gray-600 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
                <?php if ($isLoggedIn): ?>
                    <a href="dashboard1.php" class="w-full text-left bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">New Test</a>
                    <a href="auth/logout.php" class="w-full text-left bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium mt-2">Logout</a>
                <?php else: ?>
                    <a href="auth/login.php" class="w-full text-left bg-primary text-white hover:bg-secondary px-4 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="auth/register.php" class="w-full text-left bg-white text-primary border border-primary hover:bg-primary hover:text-white px-4 py-2 rounded-md text-sm font-medium mt-2">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Comprehensive Soil Information</h1>
            <p class="text-xl text-gray-700">Everything you need to know about soil for agricultural and construction purposes</p>
        </header>

        <!-- Soil Basics Section -->
        <section class="mb-16 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Soil Fundamentals</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-medium text-gray-700 mb-3">What is Soil?</h3>
                    <p class="text-gray-700 mb-4">Soil is the loose surface material that covers most land. It consists of inorganic particles and organic matter. Soil provides the structural support and the nutrient reservoir for plants used in agriculture.</p>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-2">Soil Composition:</h4>
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                            <li>Minerals (45%) - sand, silt, clay</li>
                            <li>Organic matter (5%) - decomposed plants/animals</li>
                            <li>Water (25%) - soil solution</li>
                            <li>Air (25%) - soil atmosphere</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-medium text-gray-700 mb-3">Soil Formation</h3>
                    <p class="text-gray-700 mb-3">Soil forms through the interaction of five factors:</p>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">1</span>
                            <p class="text-gray-700"><strong>Parent material</strong> - The mineral and organic material from which soil forms</p>
                        </div>
                        <div class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">2</span>
                            <p class="text-gray-700"><strong>Climate</strong> - Temperature and precipitation patterns</p>
                        </div>
                        <div class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">3</span>
                            <p class="text-gray-700"><strong>Biota</strong> - Organisms living in and on the soil</p>
                        </div>
                        <div class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">4</span>
                            <p class="text-gray-700"><strong>Topography</strong> - Landscape position</p>
                        </div>
                        <div class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">5</span>
                            <p class="text-gray-700"><strong>Time</strong> - Duration of soil formation processes</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Soil Types Section -->
        <section class="mb-16 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Soil Types & Classification</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Soil Texture Triangle</h3>
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="md:w-1/2">
                        <img src="https://www.nrcs.usda.gov/sites/default/files/2022-07/soil-texture-triangle.jpg" alt="Soil Texture Triangle" class="w-full rounded-lg border border-gray-200">
                    </div>
                    <div class="md:w-1/2">
                        <p class="text-gray-700 mb-4">Soil texture refers to the relative proportions of sand, silt, and clay particles in a soil. The soil texture triangle shows how these three components combine to form different soil textures.</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-green-50 p-3 rounded-lg">
                                <h4 class="font-semibold text-gray-800">Sand</h4>
                                <p class="text-sm text-gray-700">0.05-2.0 mm diameter</p>
                                <p class="text-sm mt-1 text-gray-700">Gritty feel, drains quickly</p>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg">
                                <h4 class="font-semibold text-gray-800">Silt</h4>
                                <p class="text-sm text-gray-700">0.002-0.05 mm diameter</p>
                                <p class="text-sm mt-1 text-gray-700">Floury feel, holds moisture</p>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg">
                                <h4 class="font-semibold text-gray-800">Clay</h4>
                                <p class="text-sm text-gray-700"><0.002 mm diameter</p>
                                <p class="text-sm mt-1 text-gray-700">Sticky when wet, hard when dry</p>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg">
                                <h4 class="font-semibold text-gray-800">Loam</h4>
                                <p class="text-sm text-gray-700">Ideal mixture</p>
                                <p class="text-sm mt-1 text-gray-700">40% sand, 40% silt, 20% clay</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-medium text-gray-700 mb-4">Major Soil Types</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Sandy Soil -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 p-3">
                            <h4 class="font-bold text-gray-900">Sandy Soil</h4>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-3">Large particles with big air spaces. Drains quickly but doesn't hold nutrients well.</p>
                            <div class="text-sm space-y-2 text-gray-700">
                                <p><span class="font-semibold">Pros:</span> Good drainage, warms quickly</p>
                                <p><span class="font-semibold">Cons:</span> Low fertility, dries out</p>
                                <p><span class="font-semibold">Crops:</span> Carrots, potatoes</p>
                            </div>
                        </div>
                    </div>

                    <!-- Clay Soil -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 p-3">
                            <h4 class="font-bold text-gray-900">Clay Soil</h4>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-3">Very small particles that pack tightly. Holds water but drains poorly.</p>
                            <div class="text-sm space-y-2 text-gray-700">
                                <p><span class="font-semibold">Pros:</span> Nutrient rich, holds moisture</p>
                                <p><span class="font-semibold">Cons:</span> Poor drainage, hard when dry</p>
                                <p><span class="font-semibold">Crops:</span> Rice, lettuce</p>
                            </div>
                        </div>
                    </div>

                    <!-- Loamy Soil -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 p-3">
                            <h4 class="font-bold text-gray-900">Loamy Soil</h4>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-3">Balanced mixture of sand, silt and clay. Ideal for most plants.</p>
                            <div class="text-sm space-y-2 text-gray-700">
                                <p><span class="font-semibold">Pros:</span> Good drainage, fertile</p>
                                <p><span class="font-semibold">Cons:</span> Can compact over time</p>
                                <p><span class="font-semibold">Crops:</span> Most vegetables, fruits</p>
                            </div>
                        </div>
                    </div>

                    <!-- Silt Soil -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 p-3">
                            <h4 class="font-bold text-gray-900">Silt Soil</h4>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-3">Medium sized particles, fertile and holds moisture well.</p>
                            <div class="text-sm space-y-2 text-gray-700">
                                <p><span class="font-semibold">Pros:</span> Fertile, holds moisture</p>
                                <p><span class="font-semibold">Cons:</span> Can compact easily</p>
                                <p><span class="font-semibold">Crops:</span> Wheat, oats</p>
                            </div>
                        </div>
                    </div>

                    <!-- Peaty Soil -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 p-3">
                            <h4 class="font-bold text-gray-900">Peaty Soil</h4>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-3">Dark, high organic matter, acidic pH.</p>
                            <div class="text-sm space-y-2 text-gray-700">
                                <p><span class="font-semibold">Pros:</span> High organic content</p>
                                <p><span class="font-semibold">Cons:</span> Acidic, may need lime</p>
                                <p><span class="font-semibold">Crops:</span> Blueberries, azaleas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chalky Soil -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-green-50 p-3">
                            <h4 class="font-bold text-gray-900">Chalky Soil</h4>
                        </div>
                        <div class="p-4">
                            <p class="text-gray-700 mb-3">Alkaline pH, often stony with free drainage.</p>
                            <div class="text-sm space-y-2 text-gray-700">
                                <p><span class="font-semibold">Pros:</span> Free draining</p>
                                <p><span class="font-semibold">Cons:</span> Alkaline, nutrient deficient</p>
                                <p><span class="font-semibold">Crops:</span> Lavender, cabbage</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Soil Properties Section -->
        <section class="mb-16 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Soil Physical & Chemical Properties</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Physical Properties -->
                <div>
                    <h3 class="text-xl font-medium text-gray-700 mb-4">Physical Properties</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Texture</h4>
                            <p class="text-gray-700">Relative proportions of sand, silt, and clay particles that affect water retention and drainage.</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Structure</h4>
                            <p class="text-gray-700">How soil particles aggregate into peds or clumps, affecting porosity and root penetration.</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Porosity</h4>
                            <p class="text-gray-700">Amount of pore space between particles that holds air and water (ideal is 50% solids, 50% pore space).</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Color</h4>
                            <p class="text-gray-700">Indicates organic matter content (dark = high) and mineral composition (red = iron oxides).</p>
                        </div>
                    </div>
                </div>

                <!-- Chemical Properties -->
                <div>
                    <h3 class="text-xl font-medium text-gray-700 mb-4">Chemical Properties</h3>
                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">pH Level</h4>
                            <p class="text-gray-700">Measure of acidity/alkalinity (0-14 scale). Most crops prefer 6.0-7.0. Affects nutrient availability.</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Cation Exchange Capacity (CEC)</h4>
                            <p class="text-gray-700">Soil's ability to hold and exchange nutrients (higher CEC = more fertile). Clay and organic matter increase CEC.</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Organic Matter</h4>
                            <p class="text-gray-700">Decomposed plant/animal material (ideal 5-10%). Improves structure, water retention, and fertility.</p>
                        </div>
                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Salinity</h4>
                            <p class="text-gray-700">Salt content that can inhibit plant growth. Measured as electrical conductivity (EC).</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Soil Testing Section -->
        <section class="mb-16 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Soil Testing Methods</h2>
            
            <div class="mb-8">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Why Test Soil?</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-2">Agricultural Benefits</h4>
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                            <li>Determine nutrient deficiencies</li>
                            <li>Optimize fertilizer application</li>
                            <li>Improve crop yields</li>
                            <li>Prevent over-fertilization</li>
                            <li>Identify pH problems</li>
                        </ul>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-2">Construction Benefits</h4>
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                            <li>Assess load-bearing capacity</li>
                            <li>Determine compaction levels</li>
                            <li>Identify drainage issues</li>
                            <li>Detect contamination</li>
                            <li>Plan foundation types</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-medium text-gray-700 mb-4">Common Soil Tests</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-green-50">
                            <tr>
                                <th class="py-2 px-4 border-b text-left font-semibold text-gray-800">Test Type</th>
                                <th class="py-2 px-4 border-b text-left font-semibold text-gray-800">What It Measures</th>
                                <th class="py-2 px-4 border-b text-left font-semibold text-gray-800">Methods</th>
                                <th class="py-2 px-4 border-b text-left font-semibold text-gray-800">Ideal Range</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- pH Test -->
                            <tr class="hover:bg-green-50">
                                <td class="py-2 px-4 border-b text-gray-700">pH Test</td>
                                <td class="py-2 px-4 border-b text-gray-700">Acidity/Alkalinity</td>
                                <td class="py-2 px-4 border-b text-gray-700">pH meter, test strips, chemical indicators</td>
                                <td class="py-2 px-4 border-b text-gray-700">6.0-7.0 for most crops</td>
                            </tr>
                            <!-- Nutrient Test -->
                            <tr class="hover:bg-green-50">
                                <td class="py-2 px-4 border-b text-gray-700">Nutrient Test</td>
                                <td class="py-2 px-4 border-b text-gray-700">N, P, K, Ca, Mg, S, micronutrients</td>
                                <td class="py-2 px-4 border-b text-gray-700">Chemical extraction, spectrometry</td>
                                <td class="py-2 px-4 border-b text-gray-700">Varies by crop and nutrient</td>
                            </tr>
                            <!-- Texture Test -->
                            <tr class="hover:bg-green-50">
                                <td class="py-2 px-4 border-b text-gray-700">Texture Test</td>
                                <td class="py-2 px-4 border-b text-gray-700">Sand, silt, clay percentages</td>
                                <td class="py-2 px-4 border-b text-gray-700">Hydrometer, feel method, sedimentation</td>
                                <td class="py-2 px-4 border-b text-gray-700">Loam ideal for most uses</td>
                            </tr>
                            <!-- Organic Matter -->
                            <tr class="hover:bg-green-50">
                                <td class="py-2 px-4 border-b text-gray-700">Organic Matter</td>
                                <td class="py-2 px-4 border-b text-gray-700">% of organic material</td>
                                <td class="py-2 px-4 border-b text-gray-700">Loss-on-ignition, Walkley-Black</td>
                                <td class="py-2 px-4 border-b text-gray-700">3-5% for agricultural soils</td>
                            </tr>
                            <!-- CEC Test -->
                            <tr class="hover:bg-green-50">
                                <td class="py-2 px-4 border-b text-gray-700">CEC Test</td>
                                <td class="py-2 px-4 border-b text-gray-700">Cation Exchange Capacity</td>
                                <td class="py-2 px-4 border-b text-gray-700">Ammonium acetate method</td>
                                <td class="py-2 px-4 border-b text-gray-700">10-25 meq/100g for crops</td>
                            </tr>
                            <!-- Compaction Test -->
                            <tr class="hover:bg-green-50">
                                <td class="py-2 px-4 border-b text-gray-700">Compaction Test</td>
                                <td class="py-2 px-4 border-b text-gray-700">Bulk density, penetration resistance</td>
                                <td class="py-2 px-4 border-b text-gray-700">Penetrometer, core sampling</td>
                                <td class="py-2 px-4 border-b text-gray-700">1.1-1.4 g/cm³ ideal</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Soil Health Section -->
        <section class="mb-16 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Soil Health & Improvement</h2>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-medium text-gray-700 mb-4">Indicators of Healthy Soil</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-gray-700">Good structure with stable aggregates</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-gray-700">Appropriate water infiltration and drainage</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-gray-700">Active, diverse microbial population</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-gray-700">Sufficient organic matter content</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-gray-700">Balanced nutrient availability</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <p class="text-gray-700">Resistance to erosion and degradation</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-medium text-gray-700 mb-4">Improving Soil Quality</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">Add Organic Matter</h4>
                            <p class="text-sm text-gray-700">Compost, manure, cover crops</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">Reduce Tillage</h4>
                            <p class="text-sm text-gray-700">Preserve soil structure</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">Crop Rotation</h4>
                            <p class="text-sm text-gray-700">Diversify nutrient demands</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">Mulching</h4>
                            <p class="text-sm text-gray-700">Conserve moisture, reduce erosion</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">pH Adjustment</h4>
                            <p class="text-sm text-gray-700">Lime for acidic, sulfur for alkaline</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-1">Avoid Compaction</h4>
                            <p class="text-sm text-gray-700">Limit heavy machinery use</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Soil Conservation Techniques</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Contour Farming</h4>
                        <p class="text-gray-700">Planting along elevation contours to reduce water runoff and soil erosion.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Terracing</h4>
                        <p class="text-gray-700">Creating stepped levels on slopes to create flat planting areas and reduce erosion.</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Windbreaks</h4>
                        <p class="text-gray-700">Rows of trees or shrubs planted to reduce wind erosion of topsoil.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8 rounded-lg">
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-4">Soil Testing System</h3>
                <p class="mb-4">Comprehensive soil information for agricultural and construction applications</p>
                <div class="flex justify-center space-x-4 mb-4">
                    <a href="#" class="hover:text-primary"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-primary"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-primary"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="hover:text-primary"><i class="fab fa-instagram"></i></a>
                </div>
                <p class="text-sm">&copy; 2023 Soil Testing System. All rights reserved.</p>
            </div>
        </footer>
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