<?php
include('config.php');
session_start();     // Starts a session so you can store user login info.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {        // Ensures the code only runs when the form is submitted using POST (not when the user just opens the page).
    // Basic input handling
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';        // trim() removes extra spaces.
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';     // isset() checks if the value exists (to avoid errors).
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (!$name || !$email || !$password || !$confirm_password) {
        echo "All fields are required.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {         // PHP’s built-in filter to check if the email looks valid (has @ and domain).
        echo "Invalid email format.";
        exit;
    }
    // extra strict regex for more detailed email format checking
    $strict_email_pattern = '/^[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?\.)+[A-Za-z]{2,63})$/';  
    if (!preg_match($strict_email_pattern, $email)) {
        echo "Invalid email format.";
        exit;
    }
    // extract the domain to make sure it exists
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

    // Database logic
    $name_safe = mysqli_real_escape_string($conn, $name);   // escaping name to prevent SQL injection (for security)
    $email_safe = mysqli_real_escape_string($conn, $email);
    $password_md5 = md5($password);        // hashing password with MD5

    // Check if email already exists
    $checkQuery = "SELECT * FROM user WHERE email='$email_safe'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already exists.";
        exit;
    }

    // Insert user
    $sql = "INSERT INTO user (email, name, password) VALUES ('$email_safe', '$name_safe', '$password_md5')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['name'] = $name;
        echo "SUCCESS|Welcome $name";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register — Modern</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
</head>
<body>
  <main class="card centered">
    <h1 class="brand">Create account</h1>

    <form id="registerForm" class="form" method="POST" action="">
      <div class="field">
        <label for="name">Full name</label>
        <input type="text" name="name" id="name" placeholder="Your name" required />
      </div>

      <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="you@domain.com" required />
      </div>

      <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password"
          placeholder="At least 8 characters, with uppercase, number, and symbol"
          required minlength="8" />
      </div>

      <div class="field">
        <label for="confirm_password">Confirm password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat password" required />
      </div>

      <button class="btn" type="submit">Create account</button>
      <div id="message" class="message" role="status" aria-live="polite"></div>
      <p class="muted">Already have an account? <a href="login.php">Sign in</a></p>
    </form>
  </main>
</body>
</html>
