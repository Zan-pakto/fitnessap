<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user is not logged in, redirect to landing page
if (!isset($_SESSION['user_id'])) {
    header("Location: landing.php");
    exit();
}

include 'includes/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <!-- Hero Section -->
    <div class="relative bg-gray-800 rounded-xl overflow-hidden mb-12">
        <div class="absolute inset-0">
            <img src="assets/images/backgrounds/background-image.jpg" alt="Fitness Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative py-16 px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-purple-300 mb-4">Transform Your Fitness Journey</h1>
            <p class="text-xl text-purple-100 mb-8">Join our community and achieve your fitness goals with expert guidance</p>
            <div class="flex justify-center space-x-4">
                <a href="workoutplans.php" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">Get Started</a>
                <a href="challenges.php" class="bg-transparent border-2 border-purple-300 text-purple-300 px-8 py-3 rounded-lg font-semibold hover:bg-purple-300 hover:text-gray-800 transition-colors">Join Challenges</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-center">
            <i class="fas fa-dumbbell text-4xl text-purple-400 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2 text-purple-200">Customized Workouts</h3>
            <p class="text-purple-100">Personalized workout plans tailored to your fitness level and goals</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-center">
            <i class="fas fa-utensils text-4xl text-purple-400 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2 text-purple-200">Nutrition Guidance</h3>
            <p class="text-purple-100">Expert advice on meal planning and healthy eating habits</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-xl shadow-lg text-center">
            <i class="fas fa-users text-4xl text-purple-400 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2 text-purple-200">Community Support</h3>
            <p class="text-purple-100">Connect with like-minded individuals on the same fitness journey</p>
        </div>
    </div>

    <!-- Popular Programs Section -->
    <h2 class="text-3xl font-bold text-center mb-8 text-white">Popular Programs</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/workouts/beginner_workout.jpg" alt="Beginner Workout" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold text-white mb-2">Choose Your Workout Plan</h3>
                <p class="text-white mb-4">Start your fitness journey with easy-to-follow exercises</p>
                <a href="workoutplans.php" class="text-purple-400 hover:text-purple-300 font-semibold">Learn More →</a>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/diets/nutrition_diet.jpg" alt="Nutrition Diet" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold text-white mb-2">Choose Your Nutrition Plan</h3>
                <p class="text-white mb-4">Balanced meal plans for optimal health and performance</p>
                <a href="nutrition.php" class="text-purple-400 hover:text-purple-300 font-semibold">Learn More →</a>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/challenges/fitness_challenges.jpg" alt="Fitness Challenges" class="w-full h-48 object-cover">
            <div class="p-6">
                <h3 class="text-xl font-bold text-white mb-2">Join a Fitness Challenge</h3>
                <p class="text-white mb-4">Join exciting challenges to push your limits</p>
                <a href="challenges.php" class="text-purple-400 hover:text-purple-300 font-semibold">Learn More →</a>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="bg-gray-800 rounded-xl p-8 mb-12">
        <h2 class="text-3xl font-bold text-center mb-8 text-purple-300">What Our Members Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">J</div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-purple-200">John D.</h4>
                        <p class="text-purple-100">Lost 20 lbs in 3 months</p>
                    </div>
                </div>
                <p class="text-purple-100">"The personalized workout plans and nutrition guidance helped me achieve my fitness goals faster than I ever imagined."</p>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">S</div>
                    <div class="ml-4">
                        <h4 class="font-semibold text-purple-200">Sarah M.</h4>
                        <p class="text-purple-100">Gained strength and confidence</p>
                    </div>
                </div>
                <p class="text-purple-100">"The community support and expert guidance made my fitness journey enjoyable and sustainable. I've never felt better!"</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-800 rounded-xl p-8 text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 text-purple-300">Ready to Explore More?</h2>
        <p class="text-xl mb-8 text-purple-100">Discover personalized workout plans and nutrition guidance</p>
        <div class="flex justify-center space-x-4">
            <a href="workoutplans.php" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">View Workout Plans</a>
            <a href="nutrition.php" class="bg-transparent border-2 border-purple-300 text-purple-300 px-8 py-3 rounded-lg font-semibold hover:bg-purple-300 hover:text-gray-800 transition-colors">Nutrition Guide</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 