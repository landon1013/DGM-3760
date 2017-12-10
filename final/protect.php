<?php
// Make sure the user is logged in before going any further
if (!isset($_COOKIE['username'])) {
  require_once('header.php');
  echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
  exit();
} // End if
?>
