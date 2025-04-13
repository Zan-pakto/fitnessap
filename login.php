<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<?php include 'includes/auth_header.php'; ?>

<div class="bg-gray-900 min-h-screen flex items-center justify-center px-4">
    <div class="bg-gray-800 shadow-xl rounded-2xl w-full max-w-md px-8 py-10 transition-all">
        <div class="flex items-center justify-center mb-4">
            <i class="fas fa-dumbbell text-3xl text-purple-400 mr-2"></i>
            <h2 id="form-title" class="text-3xl font-semibold text-white text-center">Sign In</h2>
        </div>
        <p class="text-center text-sm text-gray-300 mb-6">Fuel your fitness journey 💪</p>

        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($_GET['error']); ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="auth.php" class="space-y-5">
            <div id="name-field" class="hidden">
                <label class="block text-sm font-medium text-gray-300 mb-1" for="name">Full Name</label>
                <input id="name" name="name" type="text" class="w-full border border-gray-600 bg-gray-700 rounded-lg px-4 py-2 text-sm text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:outline-none transition-all" placeholder="John Doe">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1" for="email">Email</label>
                <input name="email" type="email" class="w-full border border-gray-600 bg-gray-700 rounded-lg px-4 py-2 text-sm text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:outline-none transition-all" placeholder="you@example.com" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1" for="password">Password</label>
                <input name="password" type="password" class="w-full border border-gray-600 bg-gray-700 rounded-lg px-4 py-2 text-sm text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:outline-none transition-all" placeholder="••••••••" required>
            </div>
            <button id="auth-btn" name="login" class="w-full bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-700 hover:to-purple-900 text-white py-2.5 rounded-lg text-sm font-medium transition-transform hover:scale-105">Sign In</button>
        </form>

        <p class="text-sm text-center text-gray-400 mt-6">
            <span id="toggle-text">Don't have an account?</span>
            <a href="#" onclick="toggleForm()" class="text-purple-400 font-semibold hover:underline transition-all">Sign Up</a>
        </p>
    </div>
</div>

<script>
let isSignUp = false;
function toggleForm() {
    isSignUp = !isSignUp;
    document.getElementById('form-title').innerText = isSignUp ? 'Sign Up' : 'Sign In';
    document.getElementById('name-field').classList.toggle('hidden', !isSignUp);
    document.getElementById('auth-btn').innerText = isSignUp ? 'Sign Up' : 'Sign In';
    document.getElementById('auth-btn').name = isSignUp ? 'signup' : 'login';
    document.getElementById('toggle-text').innerText = isSignUp ? 'Already have an account?' : "Don't have an account?";
}
</script>

<?php include 'includes/footer.php'; ?> 