<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Fitness App - Your Personal Fitness Journey</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Navigation -->
    <nav class="bg-gray-800 shadow-lg border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-dumbbell text-2xl text-purple-400"></i>
                        <span class="text-2xl font-bold text-purple-400">Fitness App</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="login.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="register.php" class="bg-purple-600 text-white hover:bg-purple-700 px-4 py-2 rounded-md text-sm font-medium">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gray-800 overflow-hidden">
        <div class="absolute inset-0">
            <img src="assets/images/backgrounds/fitness-image.jpg" alt="Fitness Background" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-gradient-to-r from-gray-900 via-gray-800 to-transparent sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <div class="inline-block">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-900 text-purple-200 mb-4">
                                <i class="fas fa-fire mr-2"></i> Start Your Journey Today
                            </span>
                        </div>
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block">Transform Your</span>
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">Fitness Journey</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Track your workouts, monitor your progress, and achieve your fitness goals with Fitness App. Your personal fitness companion.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="register.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out transform hover:scale-105">
                                    <i class="fas fa-user-plus mr-2"></i> Get Started
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="login.php" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-400 bg-gray-700 hover:bg-gray-600 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </a>
                            </div>
                        </div>
                        <div class="mt-8 flex items-center space-x-4">
                            <div class="flex -space-x-2">
                                <img class="h-10 w-10 rounded-full border-2 border-gray-800" src="https://randomuser.me/api/portraits/women/1.jpg" alt="User">
                                <img class="h-10 w-10 rounded-full border-2 border-gray-800" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User">
                                <img class="h-10 w-10 rounded-full border-2 border-gray-800" src="https://randomuser.me/api/portraits/women/2.jpg" alt="User">
                            </div>
                            <p class="text-sm text-gray-300">Join <span class="font-semibold text-purple-400">10,000+</span> members already on their fitness journey</p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-purple-400 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    Everything you need to track your fitness
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <i class="fas fa-dumbbell text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-white">Workout Tracking</h3>
                            <p class="mt-2 text-base text-gray-300">
                                Log your workouts, track your progress, and stay motivated with detailed exercise history.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-purple-500 text-white">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg leading-6 font-medium text-white">Progress Analytics</h3>
                            <p class="mt-2 text-base text-gray-300">
                                Visualize your progress with charts and analytics to help you reach your fitness goals.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to start your fitness journey?</span>
                <span class="block text-purple-400">Join Fitness App today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="register.php" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                        Get started
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 border-t border-gray-700">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-facebook text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-purple-400">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-gray-400">
                    &copy; 2024 Fitness App. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html> 