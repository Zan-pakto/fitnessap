<?php
session_start();
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $height = $_POST['height'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $fitness_goal = $_POST['fitness_goal'] ?? '';
    $activity_level = $_POST['activity_level'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || 
        empty($first_name) || empty($last_name) || empty($gender) || empty($date_of_birth) || 
        empty($fitness_goal) || empty($activity_level)) {
        $error = 'Please fill in all required fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'Email already registered';
        } else {
            // Check if username already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = 'Username already taken';
            } else {
                // Create new user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, first_name, last_name, gender, date_of_birth, height, weight, fitness_goal, activity_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt->execute([$username, $email, $hashed_password, $first_name, $last_name, $gender, $date_of_birth, $height, $weight, $fitness_goal, $activity_level])) {
                    $success = 'Registration successful! You can now login.';
                    
                    // Auto-login after registration
                    $user_id = $pdo->lastInsertId();
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    
                    // Redirect to index page
                    header("Location: index.php");
                    exit();
                } else {
                    $error = 'Registration failed. Please try again.';
                }
            }
        }
    }
}
?>

<?php include 'includes/auth_header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-8 rounded-lg shadow-xl">
        <div>
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-dumbbell text-3xl text-purple-400 mr-2"></i>
                <h2 class="text-3xl font-extrabold text-white text-center">
                    Create your account
                </h2>
            </div>
            <p class="mt-2 text-center text-sm text-gray-300">
                Or
                <a href="login.php" class="font-medium text-purple-400 hover:text-purple-300">
                    sign in to your existing account
                </a>
            </p>
        </div>

        <?php if ($error): ?>
            <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($success); ?></span>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="register.php" method="POST">
            <!-- Step 1: Account Information -->
            <div id="step1" class="space-y-4">
                <h3 class="text-xl font-bold text-purple-400 mb-4">Step 1: Account Information</h3>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-300">First Name</label>
                        <input id="first_name" name="first_name" type="text" required 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                               placeholder="John">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-300">Last Name</label>
                        <input id="last_name" name="last_name" type="text" required 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                               placeholder="Doe">
                    </div>
                </div>
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300">Username</label>
                    <input id="username" name="username" type="text" required 
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                           placeholder="johndoe">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email address</label>
                    <input id="email" name="email" type="email" required 
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                           placeholder="you@example.com">
                </div>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                               placeholder="••••••••">
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                        <input id="confirm_password" name="confirm_password" type="password" required 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                               placeholder="••••••••">
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="button" onclick="nextStep(1)" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Next <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Step 2: Personal Information -->
            <div id="step2" class="space-y-4 hidden">
                <h3 class="text-xl font-bold text-purple-400 mb-4">Step 2: Personal Information</h3>
                
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-300">Gender</label>
                    <select id="gender" name="gender" required 
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-300">Date of Birth</label>
                    <input id="date_of_birth" name="date_of_birth" type="date" required 
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm">
                </div>
                
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="height" class="block text-sm font-medium text-gray-300">Height (cm)</label>
                        <input id="height" name="height" type="number" step="0.01" 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                               placeholder="175">
                    </div>
                    <div>
                        <label for="weight" class="block text-sm font-medium text-gray-300">Weight (kg)</label>
                        <input id="weight" name="weight" type="number" step="0.01" 
                               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 placeholder-gray-400 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm" 
                               placeholder="70">
                    </div>
                </div>
                
                <div class="flex justify-between">
                    <button type="button" onclick="prevStep(2)" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </button>
                    <button type="button" onclick="nextStep(2)" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Next <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Step 3: Fitness Goals -->
            <div id="step3" class="space-y-4 hidden">
                <h3 class="text-xl font-bold text-purple-400 mb-4">Step 3: Fitness Goals</h3>
                
                <div>
                    <label for="fitness_goal" class="block text-sm font-medium text-gray-300">What is your primary fitness goal?</label>
                    <select id="fitness_goal" name="fitness_goal" required 
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm">
                        <option value="">Select Goal</option>
                        <option value="weight_loss">Weight Loss</option>
                        <option value="muscle_gain">Muscle Gain</option>
                        <option value="endurance">Endurance</option>
                        <option value="flexibility">Flexibility</option>
                        <option value="general_fitness">General Fitness</option>
                    </select>
                </div>
                
                <div>
                    <label for="activity_level" class="block text-sm font-medium text-gray-300">What is your current activity level?</label>
                    <select id="activity_level" name="activity_level" required 
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm">
                        <option value="">Select Activity Level</option>
                        <option value="sedentary">Sedentary (little or no exercise)</option>
                        <option value="light">Light (exercise 1-3 days/week)</option>
                        <option value="moderate">Moderate (exercise 3-5 days/week)</option>
                        <option value="active">Active (exercise 6-7 days/week)</option>
                        <option value="very_active">Very Active (exercise & physical job)</option>
                    </select>
                </div>
                
                <div class="flex justify-between">
                    <button type="button" onclick="prevStep(3)" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </button>
                    <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-user-plus mr-2"></i> Create Account
                    </button>
                </div>
            </div>
        </form>
        
        <!-- Progress Indicator -->
        <div class="mt-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex items-center text-purple-400">
                        <span class="h-8 w-8 rounded-full bg-purple-600 flex items-center justify-center text-white">1</span>
                        <span class="ml-2 text-sm font-medium">Account</span>
                    </div>
                    <div class="h-1 w-12 bg-gray-600 mx-2"></div>
                    <div class="flex items-center text-gray-400">
                        <span class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-white">2</span>
                        <span class="ml-2 text-sm font-medium">Personal</span>
                    </div>
                    <div class="h-1 w-12 bg-gray-600 mx-2"></div>
                    <div class="flex items-center text-gray-400">
                        <span class="h-8 w-8 rounded-full bg-gray-700 flex items-center justify-center text-white">3</span>
                        <span class="ml-2 text-sm font-medium">Goals</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function nextStep(currentStep) {
        // Hide current step
        document.getElementById('step' + currentStep).classList.add('hidden');
        
        // Show next step
        document.getElementById('step' + (currentStep + 1)).classList.remove('hidden');
        
        // Update progress indicator
        updateProgressIndicator(currentStep + 1);
    }
    
    function prevStep(currentStep) {
        // Hide current step
        document.getElementById('step' + currentStep).classList.add('hidden');
        
        // Show previous step
        document.getElementById('step' + (currentStep - 1)).classList.remove('hidden');
        
        // Update progress indicator
        updateProgressIndicator(currentStep - 1);
    }
    
    function updateProgressIndicator(currentStep) {
        // Reset all indicators
        const indicators = document.querySelectorAll('.flex.items-center');
        indicators.forEach(indicator => {
            const span = indicator.querySelector('span');
            const text = indicator.querySelector('.text-sm');
            
            span.classList.remove('bg-purple-600');
            span.classList.add('bg-gray-700');
            text.classList.remove('text-purple-400');
            text.classList.add('text-gray-400');
        });
        
        // Update current step indicator
        const currentIndicator = document.querySelector(`.flex.items-center:nth-child(${currentStep * 2 - 1})`);
        const currentSpan = currentIndicator.querySelector('span');
        const currentText = currentIndicator.querySelector('.text-sm');
        
        currentSpan.classList.remove('bg-gray-700');
        currentSpan.classList.add('bg-purple-600');
        currentText.classList.remove('text-gray-400');
        currentText.classList.add('text-purple-400');
        
        // Update progress bars
        const progressBars = document.querySelectorAll('.h-1');
        progressBars.forEach((bar, index) => {
            if (index < currentStep - 1) {
                bar.classList.remove('bg-gray-600');
                bar.classList.add('bg-purple-600');
            } else {
                bar.classList.remove('bg-purple-600');
                bar.classList.add('bg-gray-600');
            }
        });
    }
</script>

<?php include 'includes/footer.php'; ?> 