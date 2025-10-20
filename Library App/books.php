<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Books</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-50 p-6">
  <a href="index.php" class="text-blue-700 underline">← Back</a>
  <h1 class="text-2xl font-bold mb-4 text-blue-700">Books</h1>

  <form action="add_record.php" method="POST" class="mb-6 flex space-x-2">
    <input type="hidden" name="table" value="book">
    <input name="title" placeholder="Title" class="border p-2 rounded w-1/4">
    <input name="price" placeholder="Price" class="border p-2 rounded w-1/6">
    <input name="pub_id" placeholder="Publisher ID" class="border p-2 rounded w-1/6">
    <input name="category_id" placeholder="Category ID" class="border p-2 rounded w-1/6">
    <button class="bg-green-600 text-white px-4 rounded hover:bg-green-700">Add</button>
  </form>

  <table class="w-full border bg-white rounded shadow">
    <tr class="bg-blue-600 text-white text-left">
      <th class="p-2">Book ID</th>
      <th class="p-2">Title</th>
      <th class="p-2">Price</th>
      <th class="p-2">Publisher</th>
      <th class="p-2">Category</th>
      <th class="p-2">Action</th>
    </tr>

    <?php
    $res = $conn->query("SELECT * FROM BOOK");
    while ($row = $res->fetch_assoc()) {
        echo "<tr class='border-b hover:bg-gray-100'>";
        echo "<td class='p-2'>{$row['book_id']}</td>";
        echo "<td class='p-2'>{$row['title']}</td>";
        echo "<td class='p-2'>{$row['price']}</td>";
        echo "<td class='p-2'>{$row['pub_id']}</td>";
        echo "<td class='p-2'>{$row['category_id']}</td>";
        echo "<td class='p-2'><a href='delete_record.php?table=book&id={$row['book_id']}' class='text-red-600 hover:underline'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
