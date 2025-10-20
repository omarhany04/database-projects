<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrowing Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-50 p-6">
  <a href="index.php" class="text-blue-700 underline">← Back</a>
  <h1 class="text-2xl font-bold mb-4 text-blue-700">Borrowed Books</h1>

  <form action="add_record.php" method="POST" class="mb-6 flex flex-wrap gap-2">
    <input type="hidden" name="table" value="borrowing">
    <input name="member_id" placeholder="Member ID" class="border p-2 rounded w-1/6">
    <input name="book_id" placeholder="Book ID" class="border p-2 rounded w-1/6">
    <input name="borrow_date" type="date" class="border p-2 rounded w-1/6">
    <input name="due_date" type="date" class="border p-2 rounded w-1/6">
    <input name="return_date" type="date" class="border p-2 rounded w-1/6">
    <button class="bg-green-600 text-white px-4 rounded hover:bg-green-700">Add</button>
  </form>

  <table class="w-full border bg-white rounded shadow">
    <tr class="bg-blue-600 text-white text-left">
      <th class="p-2">Member ID</th>
      <th class="p-2">Book ID</th>
      <th class="p-2">Borrow Date</th>
      <th class="p-2">Due Date</th>
      <th class="p-2">Return Date</th>
      <th class="p-2">Action</th>
    </tr>

    <?php
    $res = $conn->query("SELECT * FROM BORROWING_BOOK");
    while ($row = $res->fetch_assoc()) {
        echo "<tr class='border-b hover:bg-gray-100'>";
        echo "<td class='p-2'>{$row['member_id']}</td>";
        echo "<td class='p-2'>{$row['book_id']}</td>";
        echo "<td class='p-2'>{$row['borrow_date']}</td>";
        echo "<td class='p-2'>{$row['due_date']}</td>";
        echo "<td class='p-2'>{$row['return_date']}</td>";
        echo "<td class='p-2'><a href='delete_record.php?table=borrowing&member_id={$row['member_id']}&book_id={$row['book_id']}' class='text-red-600 hover:underline'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
