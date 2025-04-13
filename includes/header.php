<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: {
                            100: '#1a1a1a',
                            200: '#2d2d2d',
                            300: '#404040',
                            400: '#525252',
                            500: '#666666',
                            600: '#808080',
                            700: '#999999',
                            800: '#b3b3b3',
                            900: '#cccccc',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Main Navigation -->
    <nav class="bg-gray-800 text-white shadow-lg border-b border-gray-700">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo and Brand -->
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center space-x-3">
                        <i class="fas fa-dumbbell text-3xl text-purple-400"></i>
                        <span class="text-2xl font-bold text-purple-400">Fitness App</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6 ml-auto">
                    <a href="workoutplans.php" class="nav-link flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-running text-lg"></i>
                        <span>Workout Plans</span>
                    </a>
                    <a href="nutrition.php" class="nav-link flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-apple-alt text-lg"></i>
                        <span>Nutrition</span>
                    </a>
                    <a href="challenges.php" class="nav-link flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-trophy text-lg"></i>
                        <span>Challenges</span>
                    </a>
                    <a href="video-courses.php" class="nav-link flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-play-circle text-lg"></i>
                        <span>Video Courses</span>
                    </a>
                    <a href="profile.php" class="nav-link flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-user text-lg"></i>
                        <span>Profile</span>
                    </a>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="logout.php" class="flex items-center space-x-2 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-sign-out-alt text-lg"></i>
                            <span>Logout</span>
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="flex items-center space-x-2 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-sign-in-alt text-lg"></i>
                            <span>Login</span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-300 hover:text-purple-400 transition-colors ml-auto">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation Menu (Hidden by default) -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="flex flex-col space-y-4 mt-4 pb-4">
                    <a href="workoutplans.php" class="flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-running text-lg"></i>
                        <span>Workout Plans</span>
                    </a>
                    <a href="nutrition.php" class="flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-apple-alt text-lg"></i>
                        <span>Nutrition</span>
                    </a>
                    <a href="challenges.php" class="flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-trophy text-lg"></i>
                        <span>Challenges</span>
                    </a>
                    <a href="video-courses.php" class="flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-play-circle text-lg"></i>
                        <span>Video Courses</span>
                    </a>
                    <a href="profile.php" class="flex items-center space-x-2 text-gray-300 hover:text-purple-400 transition-colors">
                        <i class="fas fa-user text-lg"></i>
                        <span>Profile</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="container mx-auto px-6 py-8">
    <style>
        /* Improve text readability */
        .text-gray-300 {
            color: #D1D5DB !important;
        }
        
        /* Add subtle text shadow for better contrast */
        h1, h2, h3, h4, h5, h6 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        /* Improve contrast for cards */
        .bg-gray-800 {
            background-color: rgba(31, 41, 55, 0.95);
        }
        
        /* Add hover effect for nav links */
        .nav-link:hover {
            transform: translateY(-1px);
            transition: all 0.2s;
        }
    </style> 