<?php
require_once('authorize.php');

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "SELECT * FROM blog WHERE approved=0 ORDER BY date ASC";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');
?>

<!DOCTYPE html>
<html>
  <?php include_once('header.php'); ?>
  <body>
    <?php include_once('nav.php'); ?>

    <h1>Blog Comments</h1>

    <?php
    if (mysqli_num_rows($result)== 0) {
      echo '<p>All comments have been approved</p>';
    } else {
      // DISPLAY WHAT WE FOUND
      while ($row = mysqli_fetch_array($result)) {
        echo '<article>';
        echo '<div class="flex"><a class="approve" href=approve2.php?id='.$row['id'].'>Approve</a>';
        echo '<a class="delete" href=delete.php?id='.$row['id'].'>Delete</a></div>';
        echo '<h3>'.$row['name'].'</h3>';
        echo '<p class="topic">'.$row['topic'].'</p>';
        echo '<p>'.$row['comment'].'</p>';
        echo '<p class="date">'.$row['date'].'</p>';
        echo '</article>';
      }// End While
    } // End If
  ?>
  </body>
</html>
