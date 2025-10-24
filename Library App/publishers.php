<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Publishers</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-800 p-8">
  <a href="index.php" class="back-btn">
  <span class="text-xl">←</span> Back to Dashboard
  </a>
  <h1 class="text-3xl font-bold mb-6 text-blue-400">Publishers</h1>

  <form action="add_record.php" method="POST" class="mb-8 flex flex-wrap gap-4 p-4 bg-gray-700 rounded-lg shadow-inner">
    <input type="hidden" name="table" value="publisher">
    <input name="name" placeholder="Publisher Name" class="form-input-styled w-full md:w-1/3">
    <input name="address" placeholder="Address" class="form-input-styled w-full md:w-1/3">
    <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-150">Add Record</button>
  </form>

  <table class="w-full custom-table bg-gray-700 rounded-xl shadow-2xl">
    <tr class="bg-blue-600 text-white text-left">
      <th class="p-4">Publisher ID</th>
      <th class="p-4">Name</th>
      <th class="p-4">Address</th>
      <th class="p-4">Action</th>
    </tr>

    <?php
    $res = $conn->query("SELECT * FROM PUBLISHER");
    while ($row = $res->fetch_assoc()) {
        echo "<tr class='border-b border-gray-600 hover:bg-gray-100'>";
        echo "<td class='p-4'>{$row['pub_id']}</td>";
        echo "<td class='p-4'>{$row['name']}</td>";
        echo "<td class='p-4'>{$row['address']}</td>";
        echo "<td class='p-4'><a href='delete_record.php?table=publisher&id={$row['pub_id']}' class='text-red-600 hover:underline'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
