<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SQL Queries</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 p-6">
  <a href="index.php" class="text-blue-700 underline">← Back</a>
  <h1 class="text-2xl font-bold mb-4 text-blue-700">Lab 5 Queries</h1>

  <?php
  $queries = [
    "1️⃣ Members Joined after 1-Sep-2000" =>
      "SELECT name FROM MEMBER WHERE join_date > '2000-09-01';",

    "2️⃣ Publisher Name and ID" =>
      "SELECT pub_id, name FROM PUBLISHER;",

    "3️⃣ Members Joined between 1-Oct-1995 and 1-Oct-2019" =>
      "SELECT * FROM MEMBER WHERE join_date BETWEEN '1995-10-01' AND '2019-10-01';",

    "4️⃣ Books with pub_id=2 or price between 15 and 20" =>
      "SELECT * FROM BOOK WHERE pub_id = 2 OR price BETWEEN 15 AND 20;",

    "5️⃣ Borrowing records for member id=5" =>
      "SELECT * FROM BORROWING_BOOK WHERE member_id = 5;"
  ];

  foreach ($queries as $label => $sql) {
      echo "<h2 class='text-lg font-semibold mt-6 mb-2'>$label</h2>";
      echo "<pre class='bg-gray-200 p-2 rounded'>$sql</pre>";
      $res = $conn->query($sql);
      if ($res && $res->num_rows > 0) {
          echo "<table class='w-full border bg-white mb-4'>";
          $first = true;
          while ($row = $res->fetch_assoc()) {
              if ($first) {
                  echo "<tr class='bg-blue-600 text-white'>";
                  foreach ($row as $key => $val) echo "<th class='p-2'>$key</th>";
                  echo "</tr>";
                  $first = false;
              }
              echo "<tr class='border-b'>";
              foreach ($row as $val) echo "<td class='p-2'>$val</td>";
              echo "</tr>";
          }
          echo "</table>";
      } else echo "<p class='text-gray-500'>No results found.</p>";
  }
  ?>
</body>
</html>
