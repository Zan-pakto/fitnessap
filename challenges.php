<?php include 'includes/header.php'; ?>

<div class="max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold text-center mb-8 text-white">Join a Fitness Challenge</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- 30-Day Fitness Challenge -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/challenges/30day_challenge.jpg" alt="30-Day Challenge" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">30-Day Fitness Challenge</h2>
                <p class="text-gray-600 mb-4">A progressive workout plan to build endurance and strength.</p>
                <div class="flex justify-between items-center">
                    <button onclick="toggleDetails('challenge1')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</button>
                    <span class="text-sm text-gray-500">30 days</span>
                </div>
                <div id="challenge1" class="hidden mt-4">
                    <ul class="list-disc pl-5 text-gray-600 space-y-2">
                        <li>Week 1: Light cardio & bodyweight exercises</li>
                        <li>Week 2: Increase reps & duration</li>
                        <li>Week 3: Introduce resistance training</li>
                        <li>Week 4: High-intensity workouts</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Weight Loss Challenge -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/challenges/weight_loss_challenge.png" alt="Weight Loss Challenge" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Weight Loss Challenge</h2>
                <p class="text-gray-600 mb-4">Fat-burning workouts combined with healthy meal guidance.</p>
                <div class="flex justify-between items-center">
                    <button onclick="toggleDetails('challenge2')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</button>
                    <span class="text-sm text-gray-500">60 days</span>
                </div>
                <div id="challenge2" class="hidden mt-4">
                    <ul class="list-disc pl-5 text-gray-600 space-y-2">
                        <li>Daily 20-minute HIIT workouts</li>
                        <li>Nutrition tips for calorie control</li>
                        <li>Tracking progress with weight & body fat percentage</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Strength Building Challenge -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/challenges/strength_challenge.avif" alt="Strength Challenge" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Strength Building Challenge</h2>
                <p class="text-gray-600 mb-4">Focus on lifting & bodyweight exercises for power.</p>
                <div class="flex justify-between items-center">
                    <button onclick="toggleDetails('challenge3')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</button>
                    <span class="text-sm text-gray-500">90 days</span>
                </div>
                <div id="challenge3" class="hidden mt-4">
                    <ul class="list-disc pl-5 text-gray-600 space-y-2">
                        <li>Progressive overload with weights</li>
                        <li>Upper & lower body split workouts</li>
                        <li>Strength measurement every 2 weeks</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Step Count Challenge -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/challenges/step_challenge.jpg" alt="Step Challenge" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Step Count Challenge</h2>
                <p class="text-gray-600 mb-4">Daily walking/running challenge to boost heart health.</p>
                <div class="flex justify-between items-center">
                    <button onclick="toggleDetails('challenge4')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</button>
                    <span class="text-sm text-gray-500">30 days</span>
                </div>
                <div id="challenge4" class="hidden mt-4">
                    <ul class="list-disc pl-5 text-gray-600 space-y-2">
                        <li>Start with 5,000 steps daily</li>
                        <li>Increase by 1,000 steps each week</li>
                        <li>Goal: 10,000 steps per day</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Hydration Challenge -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
            <img src="assets/images/challenges/hydration_challenge.webp" alt="Hydration Challenge" class="w-full h-60 object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Hydration Challenge</h2>
                <p class="text-gray-600 mb-4">Track and improve your daily water intake.</p>
                <div class="flex justify-between items-center">
                    <button onclick="toggleDetails('challenge5')" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">View Details</button>
                    <span class="text-sm text-gray-500">28 days</span>
                </div>
                <div id="challenge5" class="hidden mt-4">
                    <ul class="list-disc pl-5 text-gray-600 space-y-2">
                        <li>Week 1: 2L of water per day</li>
                        <li>Week 2: Increase to 2.5L</li>
                        <li>Week 3 & 4: Maintain 3L per day</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6">
            <i class="fas fa-trophy text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Track Progress</h3>
            <p class="text-gray-600">Monitor your achievements and milestones</p>
        </div>
        <div class="text-center p-6">
            <i class="fas fa-users text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Join Community</h3>
            <p class="text-gray-600">Connect with other challenge participants</p>
        </div>
        <div class="text-center p-6">
            <i class="fas fa-medal text-4xl text-blue-600 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Earn Rewards</h3>
            <p class="text-gray-600">Get recognized for your achievements</p>
        </div>
    </div>
</div>

<script>
function toggleDetails(id) {
    const section = document.getElementById(id);
    section.classList.toggle("hidden");
}
</script>

<?php include 'includes/footer.php'; ?> 