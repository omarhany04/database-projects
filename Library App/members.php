<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Members</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-50 p-6">
  <a href="index.php" class="text-blue-700 underline">← Back</a>
  <h1 class="text-2xl font-bold mb-4 text-blue-700">Members</h1>

  <form action="add_record.php" method="POST" class="mb-6 flex flex-wrap gap-2">
    <input type="hidden" name="table" value="member">
    <input name="name" placeholder="Name" class="border p-2 rounded w-1/4">
    <input name="address" placeholder="Address" class="border p-2 rounded w-1/4">
    <input name="join_date" type="date" class="border p-2 rounded w-1/6">
    <button class="bg-green-600 text-white px-4 rounded hover:bg-green-700">Add</button>
  </form>

  <table class="w-full border bg-white rounded shadow">
    <tr class="bg-blue-600 text-white text-left">
      <th class="p-2">Member ID</th>
      <th class="p-2">Name</th>
      <th class="p-2">Address</th>
      <th class="p-2">Join Date</th>
      <th class="p-2">Action</th>
    </tr>

    <?php
    $res = $conn->query("SELECT * FROM MEMBER");
    while ($row = $res->fetch_assoc()) {
        echo "<tr class='border-b hover:bg-gray-100'>";
        echo "<td class='p-2'>{$row['member_id']}</td>";
        echo "<td class='p-2'>{$row['name']}</td>";
        echo "<td class='p-2'>{$row['address']}</td>";
        echo "<td class='p-2'>{$row['join_date']}</td>";
        echo "<td class='p-2'><a href='delete_record.php?table=member&id={$row['member_id']}' class='text-red-600 hover:underline'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
