<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: landing.php");
    exit();
}

require_once 'config.php';

$user_id = $_SESSION['user_id'];
$success_message = '';
$error_message = '';

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Calculate BMI if height and weight are available
$bmi = null;
$bmi_category = '';
if (!empty($user['height']) && !empty($user['weight'])) {
    $height_m = $user['height'] / 100; // Convert cm to meters
    $bmi = $user['weight'] / ($height_m * $height_m);
    
    // Determine BMI category
    if ($bmi < 18.5) {
        $bmi_category = 'Underweight';
    } elseif ($bmi < 25) {
        $bmi_category = 'Normal weight';
    } elseif ($bmi < 30) {
        $bmi_category = 'Overweight';
    } else {
        $bmi_category = 'Obese';
    }
}

// Fetch weight tracking data
$weight_data = [];
$stmt = $pdo->prepare("SELECT weight, measurement_date FROM user_measurements WHERE user_id = ? ORDER BY measurement_date ASC");
$stmt->execute([$user_id]);
$weight_records = $stmt->fetchAll();

foreach ($weight_records as $record) {
    $weight_data[] = [
        'weight' => $record['weight'],
        'date' => $record['measurement_date']
    ];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $height = $_POST['height'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $fitness_goal = $_POST['fitness_goal'] ?? '';
    $activity_level = $_POST['activity_level'] ?? '';
    
    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_image']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($filetype), $allowed)) {
            $temp_name = $_FILES['profile_image']['tmp_name'];
            $new_filename = "profile_" . $user_id . "." . $filetype;
            $upload_path = "assets/images/profiles/" . $new_filename;
            
            if (move_uploaded_file($temp_name, $upload_path)) {
                $profile_image = $upload_path;
            }
        }
    }
    
    try {
        $sql = "UPDATE users SET 
                first_name = ?, 
                last_name = ?, 
                email = ?, 
                gender = ?, 
                date_of_birth = ?, 
                height = ?, 
                weight = ?, 
                fitness_goal = ?, 
                activity_level = ?";
        
        $params = [
            $first_name,
            $last_name,
            $email,
            $gender,
            $date_of_birth,
            $height,
            $weight,
            $fitness_goal,
            $activity_level
        ];
        
        if (isset($profile_image)) {
            $sql .= ", profile_image = ?";
            $params[] = $profile_image;
        }
        
        $sql .= " WHERE id = ?";
        $params[] = $user_id;
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        // Record weight measurement if weight has changed
        if (!empty($weight) && $weight != $user['weight']) {
            $stmt = $pdo->prepare("INSERT INTO user_measurements (user_id, weight, measurement_date) VALUES (?, ?, NOW())");
            $stmt->execute([$user_id, $weight]);
        }
        
        $success_message = "Profile updated successfully!";
        
        // Refresh user data
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        
        // Refresh weight data
        $stmt = $pdo->prepare("SELECT weight, measurement_date FROM user_measurements WHERE user_id = ? ORDER BY measurement_date ASC");
        $stmt->execute([$user_id]);
        $weight_records = $stmt->fetchAll();
        
        $weight_data = [];
        foreach ($weight_records as $record) {
            $weight_data[] = [
                'weight' => $record['weight'],
                'date' => $record['measurement_date']
            ];
        }
        
        // Recalculate BMI
        if (!empty($user['height']) && !empty($user['weight'])) {
            $height_m = $user['height'] / 100;
            $bmi = $user['weight'] / ($height_m * $height_m);
            
            if ($bmi < 18.5) {
                $bmi_category = 'Underweight';
            } elseif ($bmi < 25) {
                $bmi_category = 'Normal weight';
            } elseif ($bmi < 30) {
                $bmi_category = 'Overweight';
            } else {
                $bmi_category = 'Obese';
            }
        }
        
    } catch (PDOException $e) {
        $error_message = "Error updating profile: " . $e->getMessage();
    }
}

include 'includes/header.php';
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">My Profile</h1>
        <p class="text-gray-400 mt-2">Manage your personal information and track your fitness progress</p>
    </div>
    
    <?php if ($success_message): ?>
        <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded-lg relative mb-6 flex items-center" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <span class="block sm:inline"><?php echo htmlspecialchars($success_message); ?></span>
        </div>
    <?php endif; ?>
    
    <?php if ($error_message): ?>
        <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-lg relative mb-6 flex items-center" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
        </div>
    <?php endif; ?>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Profile Information -->
        <div class="lg:col-span-2">
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white">Profile Settings</h2>
                        <div class="bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-user-edit mr-1"></i> Edit Profile
                        </div>
                    </div>
                    
                    <form method="POST" enctype="multipart/form-data" class="space-y-6">
                        <!-- Profile Image -->
                        <div class="flex items-center space-x-6 bg-gray-700 p-4 rounded-lg">
                            <div class="shrink-0">
                                <?php if (!empty($user['profile_image'])): ?>
                                    <img class="h-24 w-24 object-cover rounded-full border-4 border-purple-500" src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile">
                                <?php else: ?>
                                    <div class="h-24 w-24 rounded-full bg-purple-600 flex items-center justify-center border-4 border-purple-500">
                                        <span class="text-3xl font-bold text-white">
                                            <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">Profile Photo</label>
                                <div class="flex items-center">
                                    <input type="file" name="profile_image" accept="image/*" class="hidden" id="profile_image_input">
                                    <label for="profile_image_input" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 cursor-pointer">
                                        <i class="fas fa-upload mr-2"></i> Upload Photo
                                    </label>
                                    <span class="ml-3 text-sm text-gray-400">JPG, PNG or GIF (max. 2MB)</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personal Information -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-white mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-300">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" 
                                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-300">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" 
                                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" 
                                           class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Physical Information -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-white mb-4">Physical Information</h3>
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-300">Gender</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-venus-mars text-gray-400"></i>
                                        </div>
                                        <select name="gender" id="gender" 
                                                class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                            <option value="">Select Gender</option>
                                            <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                            <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                            <option value="other" <?php echo $user['gender'] == 'other' ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="date_of_birth" class="block text-sm font-medium text-gray-300">Date of Birth</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-calendar-alt text-gray-400"></i>
                                        </div>
                                        <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" 
                                               class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mt-4">
                                <div>
                                    <label for="height" class="block text-sm font-medium text-gray-300">Height (cm)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-ruler-vertical text-gray-400"></i>
                                        </div>
                                        <input type="number" step="0.01" name="height" id="height" value="<?php echo htmlspecialchars($user['height']); ?>" 
                                               class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    </div>
                                </div>
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-300">Weight (kg)</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-weight text-gray-400"></i>
                                        </div>
                                        <input type="number" step="0.01" name="weight" id="weight" value="<?php echo htmlspecialchars($user['weight']); ?>" 
                                               class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fitness Goals -->
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-white mb-4">Fitness Goals</h3>
                            <div>
                                <label for="fitness_goal" class="block text-sm font-medium text-gray-300">Primary Fitness Goal</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-bullseye text-gray-400"></i>
                                    </div>
                                    <select name="fitness_goal" id="fitness_goal" 
                                            class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                        <option value="">Select Goal</option>
                                        <option value="weight_loss" <?php echo $user['fitness_goal'] == 'weight_loss' ? 'selected' : ''; ?>>Weight Loss</option>
                                        <option value="muscle_gain" <?php echo $user['fitness_goal'] == 'muscle_gain' ? 'selected' : ''; ?>>Muscle Gain</option>
                                        <option value="endurance" <?php echo $user['fitness_goal'] == 'endurance' ? 'selected' : ''; ?>>Endurance</option>
                                        <option value="flexibility" <?php echo $user['fitness_goal'] == 'flexibility' ? 'selected' : ''; ?>>Flexibility</option>
                                        <option value="general_fitness" <?php echo $user['fitness_goal'] == 'general_fitness' ? 'selected' : ''; ?>>General Fitness</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label for="activity_level" class="block text-sm font-medium text-gray-300">Activity Level</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-running text-gray-400"></i>
                                    </div>
                                    <select name="activity_level" id="activity_level" 
                                            class="pl-10 block w-full rounded-md border-gray-600 bg-gray-800 text-white shadow-sm focus:border-purple-500 focus:ring-purple-500">
                                        <option value="">Select Activity Level</option>
                                        <option value="sedentary" <?php echo $user['activity_level'] == 'sedentary' ? 'selected' : ''; ?>>Sedentary (little or no exercise)</option>
                                        <option value="light" <?php echo $user['activity_level'] == 'light' ? 'selected' : ''; ?>>Light (exercise 1-3 days/week)</option>
                                        <option value="moderate" <?php echo $user['activity_level'] == 'moderate' ? 'selected' : ''; ?>>Moderate (exercise 3-5 days/week)</option>
                                        <option value="active" <?php echo $user['activity_level'] == 'active' ? 'selected' : ''; ?>>Active (exercise 6-7 days/week)</option>
                                        <option value="very_active" <?php echo $user['activity_level'] == 'very_active' ? 'selected' : ''; ?>>Very Active (exercise & physical job)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 flex items-center">
                                <i class="fas fa-save mr-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- BMI and Weight Tracking -->
        <div class="lg:col-span-1">
            <!-- BMI Card -->
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-white">BMI Calculator</h2>
                        <div class="bg-purple-600 text-white p-2 rounded-full">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                    
                    <?php if ($bmi !== null): ?>
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center w-32 h-32 rounded-full bg-gradient-to-r from-purple-600 to-purple-800 mb-4 shadow-lg">
                                <span class="text-4xl font-bold text-white"><?php echo number_format($bmi, 1); ?></span>
                            </div>
                            <p class="text-lg font-semibold text-white"><?php echo $bmi_category; ?></p>
                        </div>
                        
                        <div class="w-full bg-gray-700 rounded-full h-4 mb-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-700 h-4 rounded-full" style="width: <?php echo min(100, max(0, ($bmi - 15) * 5)); ?>%"></div>
                        </div>
                        
                        <div class="flex justify-between text-xs text-gray-400">
                            <span>15</span>
                            <span>18.5</span>
                            <span>25</span>
                            <span>30</span>
                            <span>40</span>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="bg-gray-700 p-3 rounded-lg text-center">
                                <p class="text-sm text-gray-400">Height</p>
                                <p class="text-lg font-bold text-white"><?php echo htmlspecialchars($user['height']); ?> cm</p>
                            </div>
                            <div class="bg-gray-700 p-3 rounded-lg text-center">
                                <p class="text-sm text-gray-400">Weight</p>
                                <p class="text-lg font-bold text-white"><?php echo htmlspecialchars($user['weight']); ?> kg</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <i class="fas fa-exclamation-circle text-4xl text-gray-500 mb-4"></i>
                            <p class="text-gray-300">Enter your height and weight to calculate your BMI.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Weight Tracking Card -->
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-white">Weight Tracking</h2>
                        <div class="bg-purple-600 text-white p-2 rounded-full">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    
                    <?php if (count($weight_data) > 0): ?>
                        <div class="h-64 mb-6">
                            <canvas id="weightChart"></canvas>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Weight</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    <?php foreach (array_slice(array_reverse($weight_data), 0, 5) as $record): ?>
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-300">
                                                <?php echo date('M d, Y', strtotime($record['date'])); ?>
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-300">
                                                <?php echo $record['weight']; ?> kg
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-8">
                            <i class="fas fa-exclamation-circle text-4xl text-gray-500 mb-4"></i>
                            <p class="text-gray-300">No weight tracking data available yet.</p>
                            <p class="text-gray-400 text-sm mt-2">Update your weight to start tracking.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js for weight tracking -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <?php if (count($weight_data) > 0): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('weightChart').getContext('2d');
        
        const weightData = <?php echo json_encode($weight_data); ?>;
        
        // Format dates for display
        const labels = weightData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        });
        
        // Extract weights
        const weights = weightData.map(item => item.weight);
        
        // Create chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Weight (kg)',
                    data: weights,
                    borderColor: '#9333ea',
                    backgroundColor: 'rgba(147, 51, 234, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#9333ea',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: 'rgba(75, 85, 99, 0.5)'
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(75, 85, 99, 0.5)'
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.8)',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#9333ea',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false
                    }
                }
            }
        });
    });
    <?php endif; ?>
</script>

<?php include 'includes/footer.php'; ?> 