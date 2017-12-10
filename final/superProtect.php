<?php
if(isset($_COOKIE['username'])) {
  $user = $_COOKIE['username'];
  require_once('variables.php');

  $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

  $admin_query = "SELECT id, name, username, admin FROM final_users WHERE username = '$user'";

  $admin_result = mysqli_query($dbconnection, $admin_query) or die ('query failed');

  while ($admin_check = mysqli_fetch_array($admin_result)) {
    if ($admin_check['admin'] != 1) {
      require_once('header.php');
      echo '<p class="login">Please <a href="login.php">log in</a> as superadmin to access this page.</p>';
      exit();
    }
  }
};
?>
