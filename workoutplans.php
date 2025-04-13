<?php include 'includes/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold text-center mb-8 text-white">Choose Your Workout Plan</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Beginner Workout Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/workouts/beginner_workout.jpg" alt="Beginner Workout" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Beginner Workout</h2>
                <p class="text-gray-600 mb-4">Start your fitness journey with easy-to-follow exercises designed for beginners. Build strength and endurance at your own pace.</p>
                <div class="flex justify-between items-center">
                    <a href="beginner_workout.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</a>
                    <span class="text-sm text-gray-500">30 days</span>
                </div>
            </div>
        </div>

        <!-- Intermediate Workout Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/workouts/intermediate_workout.webp" alt="Intermediate Workout" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Intermediate Workout</h2>
                <p class="text-gray-600 mb-4">Take your fitness to the next level with moderate-intensity workouts. Challenge yourself with more complex exercises.</p>
                <div class="flex justify-between items-center">
                    <a href="intermediate_workout.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</a>
                    <span class="text-sm text-gray-500">45 days</span>
                </div>
            </div>
        </div>

        <!-- Advanced Workout Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/workouts/advanced_workout.webp" alt="Advanced Workout" class="w-full h-48 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Advanced Workout</h2>
                <p class="text-gray-600 mb-4">Push your limits with high-intensity exercises designed for experienced fitness enthusiasts. Achieve peak performance.</p>
                <div class="flex justify-between items-center">
                    <a href="advanced_workout.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</a>
                    <span class="text-sm text-gray-500">60 days</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6">
            <i class="fas fa-dumbbell text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Customized Plans</h3>
            <p class="text-gray-600">Workout plans tailored to your fitness level and goals</p>
        </div>
        <div class="text-center p-6">
            <i class="fas fa-chart-line text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Progress Tracking</h3>
            <p class="text-gray-600">Monitor your progress and achievements</p>
        </div>
        <div class="text-center p-6">
            <i class="fas fa-users text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Community Support</h3>
            <p class="text-gray-600">Join our community of fitness enthusiasts</p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 