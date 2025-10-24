<?php include 'config.php';

// --- Fetch Dashboard Statistics ---
// 1. Total Books
$res_books = $conn->query("SELECT COUNT(*) AS count FROM BOOK");
$total_books = $res_books->fetch_assoc()['count'];

// 2. Total Members
$res_members = $conn->query("SELECT COUNT(*) AS count FROM MEMBER");
$total_members = $res_members->fetch_assoc()['count'];

// 3. Total Publishers
$res_publishers = $conn->query("SELECT COUNT(*) AS count FROM PUBLISHER");
$total_publishers = $res_publishers->fetch_assoc()['count'];

// 4. Currently Borrowed (Outstanding) Books
$res_borrowed = $conn->query("SELECT COUNT(*) AS count FROM BORROWING_BOOK WHERE return_date IS NULL");
$currently_borrowed = $res_borrowed->fetch_assoc()['count'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-800">
  <div class="min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white p-4 text-center text-3xl font-extrabold shadow-2xl">
      📚 Library Management System
    </header>

    <nav class="bg-gray-700 shadow-xl p-4 flex justify-center space-x-8 text-blue-400 font-semibold border-b border-gray-600">
      <a href="books.php">Books</a>
      <a href="categories.php">Categories</a>
      <a href="publishers.php">Publishers</a>
      <a href="members.php">Members</a>
      <a href="borrowing.php">Borrowed Books</a>
      <a href="queries.php">SQL Queries</a>
    </nav>

    <main class="flex-grow flex flex-col items-center text-gray-300 p-8">
      <div class="text-center mt-10 mb-12">
        <h1 class="text-4xl font-extrabold mb-3 text-white">Welcome to the Library System</h1>
        <p class="text-lg text-gray-400">Manage all library assets and track member activity from this dashboard.</p>
      </div>

      <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <?php 
        // Helper function for consistency
        function render_stat_card($icon, $title, $value, $color) {
            echo "<div class='bg-gray-700 p-6 rounded-xl shadow-xl border-l-4 border-{$color}-500 transition duration-300 hover:scale-[1.02]'>";
            echo "<p class='text-sm text-gray-400 font-medium flex items-center'>{$icon} &nbsp; {$title}</p>";
            echo "<p class='text-4xl font-extrabold text-white mt-2'>{$value}</p>";
            echo "</div>";
        }

        render_stat_card('📖', 'Total Books', $total_books, 'blue');
        render_stat_card('👥', 'Total Members', $total_members, 'indigo');
        render_stat_card('🏢', 'Total Publishers', $total_publishers, 'purple');
        render_stat_card('⚠️', 'Outstanding Borrowed', $currently_borrowed, 'red');
        ?>
      </div>

      <div class="w-full max-w-6xl mb-12">
        <h2 class="text-2xl font-bold mb-4 text-white border-b border-gray-600 pb-2">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <a href="books.php" class="bg-blue-600 p-6 rounded-lg text-white font-bold text-lg hover:bg-blue-700 transition duration-150 shadow-lg text-center">
            ➕ Add New Book
          </a>
          <a href="members.php" class="bg-indigo-600 p-6 rounded-lg text-white font-bold text-lg hover:bg-indigo-700 transition duration-150 shadow-lg text-center">
            ➕ Register Member
          </a>
          <a href="borrowing.php" class="bg-green-600 p-6 rounded-lg text-white font-bold text-lg hover:bg-green-700 transition duration-150 shadow-lg text-center">
            🔄 Manage Borrowing
          </a>
        </div>
      </div>
    </main>

    <footer class="bg-gray-700 p-4 text-center text-gray-400 text-sm border-t border-gray-600 mt-auto">
      <p>Database Technology: MySQL | Backend: PHP | Frontend: Tailwind CSS</p>
      <p class="text-xs mt-1">Project running on XAMPP/phpMyAdmin environment.</p>
    </footer>
  </div>
</body>
</html>