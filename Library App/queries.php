<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SQL Queries</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-800 p-8">
  <a href="index.php" class="back-btn">
  <span class="text-xl">←</span> Back to Dashboard
  </a>
  <h1 class="text-3xl font-bold mb-6 text-blue-400">Practice SQL Queries</h1>

  <?php
  $queries = [
    "1) Members Joined after 1-Sep-2000" =>
      "SELECT name FROM MEMBER WHERE join_date > '2000-09-01';",

    "2) Publisher Name and ID" =>
      "SELECT pub_id, name FROM PUBLISHER;",

    "3) Members Joined between 1-Oct-1995 and 1-Oct-2019" =>
      "SELECT * FROM MEMBER WHERE join_date BETWEEN '1995-10-01' AND '2019-10-01';",

    "4) Books with pub_id=2 or price between 15 and 20" =>
      "SELECT * FROM BOOK WHERE pub_id = 2 OR price BETWEEN 15 AND 20;",

    "5) Borrowing records for member id=5" =>
      "SELECT * FROM BORROWING_BOOK WHERE member_id = 5;"
  ];

  foreach ($queries as $label => $sql) {
      echo "<h2 class='text-xl font-bold mt-8 mb-3 text-white border-b-2 border-blue-600 pb-1'>$label</h2>";
      echo "<pre class='bg-gray-700 p-4 rounded-lg text-sm text-yellow-300 font-mono shadow-md overflow-x-auto'>$sql</pre>";
      $res = $conn->query($sql);
      if ($res && $res->num_rows > 0) {
          echo "<table class='w-full custom-table bg-gray-700 rounded-xl shadow-lg mb-8'>";
          $first = true;
          while ($row = $res->fetch_assoc()) {
              if ($first) {
                  echo "<tr class='bg-blue-600 text-white'>";
                  foreach ($row as $key => $val) echo "<th class='p-4'>$key</th>";
                  echo "</tr>";
                  $first = false;
              }
              echo "<tr class='border-b border-gray-600 hover:bg-gray-100'>";
              foreach ($row as $val) echo "<td class='p-4'>$val</td>";
              echo "</tr>";
          }
          echo "</table>";
      } else echo "<p class='text-gray-400 p-2 italic'>No results found.</p>";
  }
  ?>
</body>
</html>
