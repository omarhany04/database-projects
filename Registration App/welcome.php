<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: login.php");   // Redirect to login page if not logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card centered">
    <h1>Welcome <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <p class="muted">You're signed in.</p>
    <a class="btn-outline" href="logout.php">Logout</a>
  </main>
</body>
</html>
