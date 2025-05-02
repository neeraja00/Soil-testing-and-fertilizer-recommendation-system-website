<?php
session_start();
require_once 'config/database.php';
require_once 'includes/functions.php';

$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agricultural Soil Analysis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<body class="bg-gray-100">
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
                    <a href="analysis.php" class="text-primary px-3 py-2 rounded-md text-sm font-medium">Analysis</a>
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
                <a href="analysis.php" class="text-primary block px-3 py-2 rounded-md text-base font-medium">Analysis</a>
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

    <div class="container mx-auto p-4">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-green-700">Crop-Specific Soil Analysis</h1>
        </header>

        <!-- Crop Selection -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Select Crop Type</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Crop Category</label>
                    <select id="cropCategory" class="w-full p-2 border rounded">
                        <option value="field">Field Crops</option>
                        <option value="vegetable">Vegetables</option>
                        <option value="fruit">Fruits</option>
                        <option value="livestock">Livestock Fodder</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Specific Crop</label>
                    <select id="specificCrop" class="w-full p-2 border rounded">
                        <!-- Options populated dynamically -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Soil Parameters -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Soil Parameters</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">pH Level</label>
                    <input type="number" id="ph" class="w-full p-2 border rounded" step="0.1" value="6.5">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Nitrogen (kg/ha)</label>
                    <input type="number" id="nitrogen" class="w-full p-2 border rounded" value="150">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Phosphorus (kg/ha)</label>
                    <input type="number" id="phosphorus" class="w-full p-2 border rounded" value="25">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Potassium (kg/ha)</label>
                    <input type="number" id="potassium" class="w-full p-2 border rounded" value="200">
                </div>
            </div>
            <button onclick="analyzeSoil()" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Analyze Soil
            </button>
        </div>

        <!-- Results Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Soil Requirements & Status</h3>
                <div id="soilRequirements" class="space-y-3"></div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Fertilizer Recommendations</h3>
                <div id="recommendations" class="space-y-3"></div>
            </div>
        </div>

        <!-- Charts -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Nutrient Level Comparison</h3>
            <canvas id="nutrientChart"></canvas>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Soil Health History</h3>
            <canvas id="historyChart"></canvas>
        </div>
    </div>

    <script>
        let nutrientChart = null;
        let historyChart = null;
        
        const cropData = {
            field: {
                wheat: { pH: [6.0, 7.5], N: 120, P: 40, K: 60, fertilizers: ['DAP', 'Urea', 'MOP'] },
                rice: { pH: [5.0, 6.5], N: 150, P: 50, K: 75, fertilizers: ['Ammonium Sulfate', 'SSP'] },
                maize: { pH: [5.5, 7.0], N: 130, P: 45, K: 65, fertilizers: ['NPK 10-26-26', 'Urea'] },
                cotton: { pH: [5.5, 7.5], N: 150, P: 50, K: 80, fertilizers: ['NPK 20-20-20', 'Zinc Sulfate'] },
                soybean: { pH: [6.0, 7.0], N: 110, P: 45, K: 65, fertilizers: ['Rhizobium Inoculant', 'SSP'] }
            },
            vegetable: {
                carrot: { pH: [5.5, 7.0], N: 80, P: 50, K: 100, fertilizers: ['Vermicompost', 'NPK 12-32-16'] },
                tomato: { pH: [6.0, 6.8], N: 130, P: 55, K: 110, fertilizers: ['NPK 19-19-19', 'Calcium Nitrate'] },
                potato: { pH: [5.0, 6.5], N: 120, P: 60, K: 150, fertilizers: ['Muriate of Potash', 'Bone Meal'] }
            },
            fruit: {
                mango: { pH: [5.5, 7.5], N: 100, P: 50, K: 75, fertilizers: ['NPK 6-6-6', 'Zinc Sulfate'] },
                apple: { pH: [5.8, 6.5], N: 100, P: 45, K: 70, fertilizers: ['NPK 10-10-10', 'Calcium Nitrate'] }
            },
            livestock: {
                alfalfa: { pH: [6.5, 7.5], N: 150, P: 55, K: 85, fertilizers: ['Nitrogen Fixers', 'Rock Phosphate'] },
                clover: { pH: [6.0, 7.0], N: 130, P: 45, K: 70, fertilizers: ['Biofertilizers', 'Potash'] }
            }
        };

        $(document).ready(function() {
            if (!localStorage.getItem('soilHistory')) {
                localStorage.setItem('soilHistory', JSON.stringify([]));
            }
            updateCropOptions();
            $('#cropCategory').change(updateCropOptions);
        });

        function updateCropOptions() {
            const category = $('#cropCategory').val();
            const crops = Object.keys(cropData[category]);
            $('#specificCrop').empty().append(crops.map(crop => 
                `<option value="${crop}">${crop.charAt(0).toUpperCase() + crop.slice(1)}</option>`
            ));
            analyzeSoil();
        }

        function analyzeSoil() {
            const category = $('#cropCategory').val();
            const crop = $('#specificCrop').val();
            const requirements = cropData[category][crop];
            
            const soilData = {
                ph: parseFloat($('#ph').val()) || 0,
                nitrogen: parseInt($('#nitrogen').val()) || 0,
                phosphorus: parseInt($('#phosphorus').val()) || 0,
                potassium: parseInt($('#potassium').val()) || 0,
                crop: crop,
                date: new Date().toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                })
            };

            // Save to history
            const history = JSON.parse(localStorage.getItem('soilHistory'));
            history.push(soilData);
            localStorage.setItem('soilHistory', JSON.stringify(history));

            showSoilRequirements(requirements, soilData);
            generateRecommendations(soilData, requirements);
            updateCharts(soilData, requirements, crop);
        }

        function showSoilRequirements(req, soil) {
            const phStatus = soil.ph >= req.pH[0] && soil.ph <= req.pH[1] ?
                `<span class="text-green-600">Optimal</span>` :
                `<span class="text-red-600">Needs Adjustment</span>`;

            const content = `
                <div class="space-y-2">
                    <p><strong>pH Range:</strong> ${req.pH[0]} - ${req.pH[1]} (Current: ${soil.ph}) → ${phStatus}</p>
                    <p><strong>Nitrogen:</strong> ${req.N} kg/ha (Current: ${soil.nitrogen})</p>
                    <p><strong>Phosphorus:</strong> ${req.P} kg/ha (Current: ${soil.phosphorus})</p>
                    <p><strong>Potassium:</strong> ${req.K} kg/ha (Current: ${soil.potassium})</p>
                    <p><strong>Recommended Fertilizers:</strong> ${req.fertilizers.join(', ')}</p>
                </div>
            `;
            $('#soilRequirements').html(content);
        }

        function generateRecommendations(soil, req) {
            let recommendations = '<div class="space-y-2">';
            
            // pH adjustments
            if (soil.ph < req.pH[0]) {
                recommendations += '<p class="text-red-600">✻ Apply agricultural lime to raise pH</p>';
            } else if (soil.ph > req.pH[1]) {
                recommendations += '<p class="text-red-600">✻ Apply elemental sulfur to lower pH</p>';
            }

            // Nutrient recommendations
            if (soil.nitrogen < req.N) {
                const needed = req.N - soil.nitrogen;
                recommendations += `<p class="text-blue-600">✻ Add ${needed}kg/ha nitrogen (${req.fertilizers[0]})</p>`;
            }
            if (soil.phosphorus < req.P) {
                const needed = req.P - soil.phosphorus;
                recommendations += `<p class="text-orange-600">✻ Add ${needed}kg/ha phosphorus (${req.fertilizers[1]})</p>`;
            }
            if (soil.potassium < req.K) {
                const needed = req.K - soil.potassium;
                recommendations += `<p class="text-green-600">✻ Add ${needed}kg/ha potassium (${req.fertilizers[2] || req.fertilizers[1]})</p>`;
            }

            recommendations += '</div>';
            $('#recommendations').html(recommendations);
        }

        function updateCharts(soilData, requirements, cropType) {
            updateNutrientChart(soilData, requirements);
            updateHistoryChart(cropType);
        }

        function updateNutrientChart(soil, req) {
            const ctx = document.getElementById('nutrientChart');
            if (nutrientChart) nutrientChart.destroy();

            // Calculate maximum value for scaling
            const maxValue = Math.max(
                soil.nitrogen, soil.phosphorus, soil.potassium,
                req.N, req.P, req.K
            ) * 1.2; // Add 20% padding

            nutrientChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Nitrogen', 'Phosphorus', 'Potassium'],
                    datasets: [{
                        label: 'Current Levels',
                        data: [soil.nitrogen, soil.phosphorus, soil.potassium],
                        backgroundColor: 'rgba(54, 162, 235, 0.7)'
                    }, {
                        label: 'Recommended Levels',
                        data: [req.N, req.P, req.K],
                        backgroundColor: 'rgba(75, 192, 192, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: maxValue,
                            title: {
                                display: true,
                                text: 'kg/ha'
                            },
                            ticks: {
                                precision: 0,
                                stepSize: Math.ceil(maxValue / 10)
                            }
                        }
                    }
                }
            });
        }

        function updateHistoryChart(cropType) {
            const ctx = document.getElementById('historyChart');
            if (historyChart) historyChart.destroy();

            const history = JSON.parse(localStorage.getItem('soilHistory'))
                .filter(entry => entry.crop === cropType)
                .slice(-5);

            // Get all values for scaling
            const allValues = history.reduce((acc, entry) => {
                return acc.concat([entry.ph, entry.nitrogen, entry.phosphorus, entry.potassium]);
            }, []);

            const maxValue = Math.max(...allValues) * 1.1;
            const minValue = Math.min(...allValues) * 0.9;

            historyChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: history.map(entry => entry.date),
                    datasets: [{
                        label: 'pH Level',
                        data: history.map(entry => entry.ph),
                        borderColor: '#ff6384',
                        yAxisID: 'y',
                        tension: 0.1
                    }, {
                        label: 'Nitrogen (kg/ha)',
                        data: history.map(entry => entry.nitrogen),
                        borderColor: '#36a2eb',
                        yAxisID: 'y1',
                        tension: 0.1
                    }, {
                        label: 'Phosphorus (kg/ha)',
                        data: history.map(entry => entry.phosphorus),
                        borderColor: '#ffce56',
                        yAxisID: 'y1',
                        tension: 0.1
                    }, {
                        label: 'Potassium (kg/ha)',
                        data: history.map(entry => entry.potassium),
                        borderColor: '#4bc0c0',
                        yAxisID: 'y1',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: { text: 'pH Level', display: true },
                            min: 0,
                            max: 14,
                            ticks: { stepSize: 1 }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: { text: 'Nutrients (kg/ha)', display: true },
                            min: minValue,
                            max: maxValue,
                            grid: { drawOnChartArea: false },
                            ticks: {
                                precision: 0,
                                stepSize: Math.ceil((maxValue - minValue) / 10)
                            }
                        }
                    }
                }
            });
        }

        // Mobile menu toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>
</body>
</html>