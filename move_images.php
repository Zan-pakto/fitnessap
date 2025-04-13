<?php
// Define source and destination directories
$sourceDir = __DIR__;
$destDir = __DIR__ . '/assets/images';

// Create category directories if they don't exist
$categories = ['workouts', 'diets', 'challenges', 'turfs', 'logos', 'backgrounds'];
foreach ($categories as $category) {
    if (!file_exists($destDir . '/' . $category)) {
        mkdir($destDir . '/' . $category, 0777, true);
    }
}

// Define image mappings
$imageMappings = [
    'workouts' => [
        'beginner_workout.jpg',
        'intermediate_workout.webp',
        'advanced_workout.webp',
        'fitness_workout.avif'
    ],
    'diets' => [
        'weight_loss_diet.png',
        'muscle_gain_diet.jpg',
        'healthy_meals.jpg',
        'nutrition_diet.jpg'
    ],
    'challenges' => [
        'weight_loss_challenge.png',
        'strength_challenge.avif',
        'step_challenge.jpg',
        'hydration_challenge.webp',
        '30day_challenge.jpg',
        'fitness_challenges.jpg'
    ],
    'turfs' => [
        'turf1.jpg',
        'turf2.jpg',
        'turf3.webp',
        'turf4.jpg',
        'turf5.jpg',
        'turf6.jpg'
    ],
    'logos' => [
        'RETRO.png',
        'RETRO SANDAL.png',
        'RETRO LLW.png'
    ],
    'backgrounds' => [
        'background-image.jpg',
        'fitness-image.jpg',
        'sports-image.jpg',
        'about_us.jpg',
        'left-image.avif',
        'right-image.jpg',
        'plans&pricing.png',
        'video_courses.jpg'
    ]
];

// Move files to their respective directories
foreach ($imageMappings as $category => $files) {
    foreach ($files as $file) {
        $source = $sourceDir . '/' . $file;
        $dest = $destDir . '/' . $category . '/' . $file;
        
        if (file_exists($source)) {
            if (rename($source, $dest)) {
                echo "Moved $file to $category directory\n";
            } else {
                echo "Failed to move $file\n";
            }
        } else {
            echo "File $file not found\n";
        }
    }
}

echo "Image organization complete!\n";
?> 