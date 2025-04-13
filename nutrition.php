<?php include 'includes/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold text-center mb-8 text-white">Choose Your Nutrition Plan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Healthy Meal Plans Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/diets/healthy_meals.jpg" alt="Healthy Meals" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Healthy Meal Plans</h2>
                <p class="text-gray-600 mb-4">Balanced meals for maintaining a healthy lifestyle. Perfect for those looking to improve their overall diet.</p>
                <div class="flex justify-between items-center">
                    <a href="mealplans.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Plans</a>
                    <span class="text-sm text-gray-500">30 days</span>
                </div>
            </div>
        </div>

        <!-- Weight Loss Diet Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/diets/weight_loss_diet.png" alt="Weight Loss Diet" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Weight Loss Diet</h2>
                <p class="text-gray-600 mb-4">Special meal plans designed to help you lose weight effectively. Customized for your body type and goals.</p>
                <div class="flex justify-between items-center">
                    <a href="weightloss.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Plans</a>
                    <span class="text-sm text-gray-500">60 days</span>
                </div>
            </div>
        </div>

        <!-- Muscle Gain Diet Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/diets/muscle_gain_diet.jpg" alt="Muscle Gain Diet" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Muscle Gain Diet</h2>
                <p class="text-gray-600 mb-4">High-protein diets to build muscle and strength. Optimized for maximum muscle growth and recovery.</p>
                <div class="flex justify-between items-center">
                    <a href="musclegain.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Plans</a>
                    <span class="text-sm text-gray-500">90 days</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6">
            <i class="fas fa-apple-alt text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Balanced Nutrition</h3>
            <p class="text-gray-600">Meal plans with the perfect balance of nutrients</p>
        </div>
        <div class="text-center p-6">
            <i class="fas fa-utensils text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Customized Plans</h3>
            <p class="text-gray-600">Tailored to your specific dietary needs</p>
        </div>
        <div class="text-center p-6">
            <i class="fas fa-chart-line text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Progress Tracking</h3>
            <p class="text-gray-600">Monitor your nutrition journey</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 