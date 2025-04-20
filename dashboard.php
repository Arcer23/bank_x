<?php
session_start();

// Regenerate session to prevent fixation
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);

// Example user data (in real app, you'd fetch this from DB)
$balance = 10450.75;
$transactions = [
    ["label" => "Starbucks", "amount" => -5.80],
    ["label" => "Salary", "amount" => 2000],
    ["label" => "Netflix", "amount" => -15.99],
    ["label" => "Transfer to Amy", "amount" => -250],
    ["label" => "Cashback", "amount" => 12.5],
];
?>

<!DOCTYPE html>
<html lang="en" class="transition-colors">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyBank Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

<!-- Navbar -->
<nav class="bg-white dark:bg-gray-800 shadow-md px-6 py-4">
  <div class="max-w-7xl mx-auto flex justify-between items-center">
    <a class="text-2xl font-bold text-blue-600 dark:text-blue-400" href="#">MyBank</a>

    <div class="flex items-center gap-4">
      <span>Hello, <strong class="text-blue-600 dark:text-blue-400"><?= $username ?></strong></span>

      <!-- Dark Mode Toggle -->
      <button onclick="toggleDarkMode()" class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition">
        <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor">
          <path id="sun-icon" d="M12 4V2m0 20v-2m8-8h2M2 12h2m15.364-6.364L18.364 7.636M5.636 18.364L7.636 16.364M18.364 16.364L16.364 18.364M5.636 5.636L7.636 7.636" />
        </svg>
      </button>

      <!-- Avatar -->
      <div class="relative group">
        <img src="https://i.pravatar.cc/36?u=<?= urlencode($username) ?>" class="w-9 h-9 rounded-full cursor-pointer border" />
        <div class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-700 rounded-lg shadow-lg hidden group-hover:block">
          <a href="account-settings.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Settings</a>
          <a href="logout.php" class="block px-4 py-2 text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-600">Logout</a>
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Dashboard -->
<div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-10 fade-in">
  <!-- Overview -->
  <div class="space-y-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
      <h2 class="text-xl font-semibold mb-4">Account Balance</h2>
      <p class="text-4xl font-bold text-green-600 dark:text-green-400">$<?= number_format($balance, 2) ?></p>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
      <h2 class="text-xl font-semibold mb-4">Recent Transactions</h2>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        <?php foreach ($transactions as $tx): ?>
          <li class="flex justify-between py-2">
            <span><?= $tx['label'] ?></span>
            <span class="<?= $tx['amount'] >= 0 ? 'text-green-500' : 'text-red-500' ?>">
              <?= $tx['amount'] >= 0 ? '+ $' : '- $' ?><?= number_format(abs($tx['amount']), 2) ?>
            </span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- Chart -->
  <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold mb-4">Spending Overview</h2>
    <canvas id="spendingChart" height="300"></canvas>
  </div>
</div>

<script>
function toggleDarkMode() {
  document.documentElement.classList.toggle('dark');
  localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
}

if (localStorage.getItem('theme') === 'dark') {
  document.documentElement.classList.add('dark');
}

// Chart.js Config
const ctx = document.getElementById('spendingChart').getContext('2d');
const spendingChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
      label: 'Expenses',
      data: [20, 45, 25, 60, 30, 50, 70],
      borderColor: '#3B82F6',
      backgroundColor: 'rgba(59, 130, 246, 0.1)',
      tension: 0.4,
      fill: true,
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
</body>
</html>

