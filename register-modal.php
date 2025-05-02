<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Create Account</h2>
                    <button id="closeRegisterModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <p class="text-gray-600 mb-6">Join our community of farmers optimizing their soil health</p>
                
                <form id="registerForm" action="auth/register.php" method="POST" class="space-y-4">
                    <div>
                        <label for="registerName" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="registerName" name="name" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Enter your full name">
                    </div>
                    
                    <div>
                        <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="registerEmail" name="email" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Enter your email">
                    </div>
                    
                    <div>
                        <label for="registerPassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="registerPassword" name="password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Create a password">
                    </div>
                    
                    <div>
                        <label for="registerConfirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" id="registerConfirmPassword" name="confirm_password" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                               placeholder="Confirm your password">
                    </div>
                    
                    <div>
                        <label for="registerFarmType" class="block text-sm font-medium text-gray-700 mb-1">Farm Type</label>
                        <select id="registerFarmType" name="farm_type" required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                            <option value="">Select farm type</option>
                            <option value="crops">Field Crops</option>
                            <option value="vegetables">Vegetables</option>
                            <option value="fruits">Fruits</option>
                            <option value="livestock">Livestock</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="agreeTerms" name="agree_terms" required 
                               class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="agreeTerms" class="ml-2 block text-sm text-gray-700">
                            I agree to the <a href="#" class="text-primary hover:text-secondary">Terms of Service</a> and 
                            <a href="#" class="text-primary hover:text-secondary">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Create Account
                    </button>
                    
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="#" id="switchToLogin" class="text-primary hover:text-secondary">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 