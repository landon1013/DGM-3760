<?php
require_once('protect.php');

$add = '/midterm/add.php';
$update = '/midterm/details.php?id=' . $_GET[id];
$currentpage = $_SERVER['REQUEST_URI'];

if ($_COOKIE['username'] == 'landon1013' && $currentpage == $update) {
  echo '<a href="delete.php?id=' . $row['id'] .  '&amp;image=' . $row['image'] . '"><div class="btn">Delete</div></a>';
  exit;
} else if ($_COOKIE['username'] == 'landon1013' && $currentpage == $add) {
  echo '<h1>New Admin User</h1>';
  echo '<form method="post" action="add.php" enctype="multipart/form-data">';
    echo '<fieldset>';
      echo '<legend>';
        echo 'User Info';
      echo '</legend>';
      echo '<label>';
        echo '<p>Name:</p>';
        echo '<input type="text" name="name" value="" placeholder="John Smith" required />';
      echo '</label>';

      echo '<label>';
        echo '<p>Username:</p>';
        echo '<input type="text" name="username" value="" placeholder="username" required />';
      echo '</label>';

      echo '<label>';
        echo '<p>Password:</p>';
        echo '<input type="password" name="password1" value="" placeholder="password" required />';
      echo '</label>';

      echo '<label>';
        echo '<p>Confirm Password:</p>';
        echo '<input type="password" name="password2" value="" placeholder="confirm" required />';
      echo '</label>';
    echo '</fieldset>';
    echo '<input type="submit" value="Add Admin" name="submitAdmin" />';
  echo '</form>';
}
?>
