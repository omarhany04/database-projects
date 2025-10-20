<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library Management</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">
  <div class="min-h-screen flex flex-col">
    <header class="bg-blue-700 text-white p-4 text-center text-2xl font-bold">
      📚 Library Management System
    </header>

    <nav class="bg-white shadow p-4 flex justify-center space-x-6 text-blue-700 font-semibold">
      <a href="books.php">Books</a>
      <a href="categories.php">Categories</a>
      <a href="publishers.php">Publishers</a>
      <a href="members.php">Members</a>
      <a href="borrowing.php">Borrowed Books</a>
      <a href="queries.php">SQL Queries</a>
    </nav>

    <main class="flex-grow flex items-center justify-center text-gray-700">
      <div class="text-center mt-10">
        <h1 class="text-3xl font-bold mb-2">Welcome to the Library System</h1>
        <p class="text-lg">Select a table to view or manage records.</p>
      </div>
    </main>
  </div>
</body>
</html>
