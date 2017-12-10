<?php
$admin = $_COOKIE['username'];

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "SELECT id, name, username, admin FROM final_users WHERE username = '$admin'";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

while($row2 = mysqli_fetch_array($result)) {
  if ($row2['admin'] == 1) {
    echo '<a href="update.php?id=' . $row['id'] . '"><div class="btn">Update</div></a>';
    echo '<a href="delete.php?id=' . $row['id'] .  '&amp;image=' . $row['image'] . '"><div class="btn">Delete</div></a>';
  }
}
?>
