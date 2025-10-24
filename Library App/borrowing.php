<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Borrowing Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-800 p-8">
  <a href="index.php" class="back-btn">
  <span class="text-xl">←</span> Back to Dashboard
  </a>
  <h1 class="text-3xl font-bold mb-6 text-blue-400">Borrowed Books</h1>

  <form action="add_record.php" method="POST" class="mb-8 flex flex-wrap gap-4 p-4 bg-gray-700 rounded-lg shadow-inner">
    <input type="hidden" name="table" value="borrowing">
    <input name="member_id" placeholder="Member ID" class="form-input-styled w-full md:w-1/6">
    <input name="book_id" placeholder="Book ID" class="form-input-styled w-full md:w-1/6">
    <input name="borrow_date" type="date" class="form-input-styled w-full md:w-1/6">
    <input name="due_date" type="date" class="form-input-styled w-full md:w-1/6">
    <input name="return_date" type="date" class="form-input-styled w-full md:w-1/6">
    <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-150">Add Record</button>
  </form>

  <table class="w-full custom-table bg-gray-700 rounded-xl shadow-2xl">
    <tr class="bg-blue-600 text-white text-left">
      <th class="p-4">Member ID</th>
      <th class="p-4">Book ID</th>
      <th class="p-4">Borrow Date</th>
      <th class="p-4">Due Date</th>
      <th class="p-4">Return Date</th>
      <th class="p-4">Action</th>
    </tr>

    <?php
    $res = $conn->query("SELECT * FROM BORROWING_BOOK");
    while ($row = $res->fetch_assoc()) {
        echo "<tr class='border-b border-gray-600 hover:bg-gray-100'>";
        echo "<td class='p-4'>{$row['member_id']}</td>";
        echo "<td class='p-4'>{$row['book_id']}</td>";
        echo "<td class='p-4'>{$row['borrow_date']}</td>";
        echo "<td class='p-4'>{$row['due_date']}</td>";
        echo "<td class='p-4'>{$row['return_date']}</td>";
        echo "<td class='p-4'><a href='delete_record.php?table=borrowing&member_id={$row['member_id']}&book_id={$row['book_id']}' class='text-red-600 hover:underline'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
