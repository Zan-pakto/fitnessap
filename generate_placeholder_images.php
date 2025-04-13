<?php
// Function to create a colored rectangle image
function createPlaceholderImage($width, $height, $text, $bgColor, $textColor) {
    $image = imagecreatetruecolor($width, $height);
    
    // Convert hex colors to RGB
    $bgRGB = sscanf($bgColor, "#%02x%02x%02x");
    $textRGB = sscanf($textColor, "#%02x%02x%02x");
    
    // Create colors
    $bg = imagecolorallocate($image, $bgRGB[0], $bgRGB[1], $bgRGB[2]);
    $text = imagecolorallocate($image, $textRGB[0], $textRGB[1], $textRGB[2]);
    
    // Fill background
    imagefilledrectangle($image, 0, 0, $width, $height, $bg);
    
    // Add text
    $fontSize = 5;
    $fontWidth = imagefontwidth($fontSize);
    $fontHeight = imagefontheight($fontSize);
    $textWidth = strlen($text) * $fontWidth;
    $x = ($width - $textWidth) / 2;
    $y = ($height - $fontHeight) / 2;
    imagestring($image, $fontSize, $x, $y, $text, $text);
    
    return $image;
}

// Create directories if they don't exist
$directories = [
    'assets/backgrounds',
    'assets/workouts',
    'assets/diets',
    'assets/challenges'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Generate images
$images = [
    'assets/backgrounds/fitness-image.jpg' => ['Fitness Background', '#9333ea', '#ffffff'],
    'assets/workouts/beginner_workout.jpg' => ['Beginner Workout', '#14b8a6', '#ffffff'],
    'assets/diets/nutrition_diet.jpg' => ['Nutrition Diet', '#14b8a6', '#ffffff'],
    'assets/challenges/fitness_challenges.jpg' => ['Fitness Challenges', '#14b8a6', '#ffffff']
];

foreach ($images as $path => $details) {
    $image = createPlaceholderImage(800, 600, $details[0], $details[1], $details[2]);
    imagejpeg($image, $path, 90);
    imagedestroy($image);
}

echo "Placeholder images have been generated successfully!";
?> 