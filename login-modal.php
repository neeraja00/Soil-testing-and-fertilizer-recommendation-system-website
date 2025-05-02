<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Welcome Back</h2>
                    <button id="closeLoginModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <p class="text-gray-600 mb-6">Login to access your soil analysis dashboard</p>
                
                <form id="loginForm" action="auth/login.php" method="POST" class="space-y-4">
                    <div>
                        <label for="loginEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="loginEmail" name="email" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Enter your email">
                    </div>
                    
                    <div>
                        <label for="loginPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="loginPassword" name="password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Enter your password">
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="rememberMe" 
                                   class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="rememberMe" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-primary hover:text-secondary">Forgot password?</a>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Login
                    </button>
                    
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">
                            Don't have an account? 
                            <a href="#" id="switchToRegister" class="text-primary hover:text-secondary">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 