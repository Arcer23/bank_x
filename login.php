<?php
session_start();
require 'db.php'; // adjust path if needed

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No account found with that email.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MyBank | Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .fade-in, .fade-up { animation: fadeIn 1s ease-out; }
  </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

  <!-- Navbar -->
  <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <a href="./index.php" class="text-2xl font-bold text-blue-600">MyBank</a>
      <div class="space-x-4 hidden md:flex">
        <a href="login.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Login</a>
        <a href="signup.php" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Sign Up</a>
      </div>
    </div>
  </nav>

  <!-- Login Section -->
  <section class="flex items-center justify-center px-4 py-16 fade-in flex-grow">
    <form action="login.php" method="POST" class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
      <h3 class="text-2xl font-bold text-center text-gray-700 mb-6">Log In</h3>

      <?php if (!empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block text-gray-600 font-semibold mb-2">Email</label>
        <input type="email" name="email" id="email" required autofocus class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-gray-600 font-semibold mb-2">Password</label>
        <input type="password" name="password" id="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- Submit -->
      <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Login</button>

      <!-- Forgot -->
      <div class="text-center mt-4">
        <a href="#" class="text-blue-500 hover:text-blue-700 text-sm">Forgot Password?</a>
      </div>
    </form>
  </section>

  <footer class="bg-gray-200 text-center py-4 mt-12">
    <p class="text-gray-600">&copy; 2025 MyBank. All rights reserved.</p>
  </footer>
</body>
</html>
