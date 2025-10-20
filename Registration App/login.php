<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!$email || !$password) {
        echo "Email and password required.";
        exit;
    }

    // Strict email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $strict_email_pattern = '/^[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?\.)+[A-Za-z]{2,63})$/';
    if (!preg_match($strict_email_pattern, $email)) {
        echo "Invalid email format.";
        exit;
    }

    $domain = substr(strrchr($email, "@"), 1);
    if (!$domain) {
        echo "Invalid email format.";
        exit;
    }

    // Strong password validation
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($password_pattern, $password)) {
        echo "Password must be at least 8 characters and include:
        one uppercase letter, one lowercase letter, one number, and one special character.";
        exit;
    }

    // Database login check
    $email_safe = mysqli_real_escape_string($conn, $email);
    $password_md5 = md5($password);

    $sql = "SELECT * FROM user WHERE email='$email_safe' AND password='$password_md5'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $user['name'];
        echo "SUCCESS|Welcome " . $user['name'];
    } else {
        echo "Invalid Email or Password";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login — Modern</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
  <main class="card centered">
    <h1 class="brand">Welcome back</h1>

    <form id="loginForm" class="form" method="POST" action="">
      <div class="field">
        <label for="login_email">Email</label>
        <input type="email" name="email" id="login_email" placeholder="you@domain.com" required />
      </div>

      <div class="field">
        <label for="login_password">Password</label>
        <input type="password" name="password" id="login_password" placeholder="Your password" required />
      </div>

      <button class="btn" type="submit">Sign in</button>
      <div id="login_message" class="message" role="status" aria-live="polite"></div>
      <p class="muted">New here? <a href="register.php">Create account</a></p>
    </form>
  </main>
</body>
</html>
