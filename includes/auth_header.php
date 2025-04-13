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
    <!-- Auth Navigation -->
    <nav class="bg-gray-800 text-white shadow-lg border-b border-gray-700">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-4">
                    <a href="landing.php" class="flex items-center space-x-3">
                        <i class="fas fa-dumbbell text-3xl text-purple-400"></i>
                        <span class="text-2xl font-bold text-purple-400">Fitness App</span>
                    </a>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    <a href="landing.php" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                </div>
            </div>
        </div>
    </nav> 