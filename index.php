<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyBank | Welcome</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeIn 1s ease-out;
    }

    .fade-up {
      animation: fadeIn 1s ease-out;
    }

    .transition-all {
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-md transition-all">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <a href="./index.php" target="_blank" class="text-2xl font-bold text-blue-600">MyBank</a>
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

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="md:hidden bg-white shadow-md hidden">
      <a href="login.php" class="block px-4 py-2 text-gray-600">Login</a>
      <a href="signup.php" class="block px-4 py-2 text-gray-600">Sign Up</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto px-4 py-16 fade-in">
    <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
      <h2 class="text-4xl font-bold text-gray-800 mb-4">Welcome to <span class="text-blue-500">MyBank</span></h2>
      <p class="text-gray-600 mb-6">Your secure, smart, and simple banking partner. Easily manage your finances, transfer funds, and much more — all in one place.</p>
      <a href="signup.php" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-all">Get Started</a>
    </div>
    <div class="md:w-1/2 fade-up">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135706.png" alt="Banking" class="w-full max-w-sm mx-auto transform transition-all duration-500 hover:scale-105">
    </div>
  </section>

  <!-- Features Section -->
  <section class="bg-white py-12 fade-in">
    <div class="max-w-6xl mx-auto px-4">
      <h3 class="text-2xl font-semibold text-center text-gray-800 mb-10">Why Choose MyBank?</h3>
      <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center p-6 shadow rounded-lg transform transition-all duration-300 hover:scale-105">
          <div class="text-blue-500 text-4xl mb-4">💳</div>
          <h4 class="font-bold text-lg mb-2">Secure Transactions</h4>
          <p class="text-gray-600">Top-tier security ensures all your transactions and data stay protected.</p>
        </div>
        <div class="text-center p-6 shadow rounded-lg transform transition-all duration-300 hover:scale-105">
          <div class="text-blue-500 text-4xl mb-4">📱</div>
          <h4 class="font-bold text-lg mb-2">Mobile Access</h4>
          <p class="text-gray-600">Bank from anywhere using our user-friendly mobile interface.</p>
        </div>
        <div class="text-center p-6 shadow rounded-lg transform transition-all duration-300 hover:scale-105">
          <div class="text-blue-500 text-4xl mb-4">🚀</div>
          <h4 class="font-bold text-lg mb-2">Fast Services</h4>
          <p class="text-gray-600">Enjoy instant transfers, bill payments, and real-time account updates.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-200 text-center py-4 mt-10 fade-in">
    <p class="text-gray-600">&copy; 2025 MyBank. All rights reserved.</p>
  </footer>

  <script>
    // Toggle mobile menu
    document.getElementById('menu-toggle').addEventListener('click', () => {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
