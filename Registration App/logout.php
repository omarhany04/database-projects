<?php
session_start();   
session_destroy();                  // Destroys session data so the user is logged out
header("Location: login.php");      // Redirect to login page
exit;
?>
