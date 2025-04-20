<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php?signup=success");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyBank | Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .fade-in, .fade-up {
      animation: fadeIn 1s ease-out;
    }

    .transition-all {
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white shadow-md transition-all">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="./index.php" class="text-2xl font-bold text-blue-600">MyBank</a>
      <div class="space-x-4 hidden md:flex">
        <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">Login</a>
        <a href="signup.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">Sign Up</a>
      </div>
      <!-- Mobile Menu -->
      <div class="md:hidden">
        <button id="menu-toggle" class="text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12h18M3 6h18M3 18h18"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-white shadow-md hidden">
      <a href="login.php" class="block px-4 py-2 text-gray-600">Login</a>
      <a href="signup.php" class="block px-4 py-2 text-gray-600">Sign Up</a>
    </div>
  </nav>

  <!-- Sign Up Section -->
  <section class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-4 py-16 fade-in flex-grow">
    <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
      <h2 class="text-4xl font-bold text-gray-800 mb-4">Create your <span class="text-blue-500">MyBank</span> Account</h2>
      <p class="text-gray-600 mb-6">Welcome to MyBank! Please sign up to get started with your personal banking services.</p>
    </div>
    <div class="md:w-1/2 fade-up">
      <form method="POST" class="bg-white p-8 rounded-lg shadow-lg max-w-sm mx-auto">
        <h3 class="text-2xl font-bold text-center text-gray-700 mb-6">Sign Up</h3>

        <!-- Error Message -->
        <?php if (isset($error)): ?>
          <p class="text-red-500 mb-4 text-center"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- Username -->
        <div class="mb-4">
          <label for="username" class="block text-gray-600 font-semibold mb-2">Username</label>
          <input type="text" name="username" id="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
          <input type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div class="mb-4">
          <label for="password" class="block text-gray-600 font-semibold mb-2">Password</label>
          <input type="password" name="password" id="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Submit -->
        <button type="submit" name="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">Sign Up</button>

        <!-- Login Redirect -->
        <div class="text-center mt-4">
          <p class="text-gray-600">Already have an account? <a href="login.php" class="text-blue-500 hover:text-blue-700">Login here</a></p>
        </div>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-200 text-center py-4 mt-12 fade-in">
    <p class="text-gray-600">&copy; 2025 MyBank. All rights reserved.</p>
  </footer>

  <script>
    // Mobile menu toggle
    document.getElementById('menu-toggle').addEventListener('click', () => {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
