<?php
//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

//BUILD THE query
$query = "SELECT * FROM album_simple ORDER BY artist ASC";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Remove Album</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php include('nav.php'); ?>
    <h1>Remove Album</h1>

    <?php
    // DISPLAY WHAT WE FOUND
    while ($row = mysqli_fetch_array($result)) {
      echo '<p>';
      echo $row['artist'] .', '. $row['album'].' - ' .$row['genre'];
      echo ' <a href="delete.php?id='. $row['id'].'">Delete</a>';
      echo '</p>';
    }
    ?>
  </body>
</html>
