<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>View</title>
  </head>
  <body>
    <?php include('nav.php'); ?>
    <h1>Favorite Albums</h1>
    <?php
    //BUILD THE DATABASE CONNECTION WITH host, user, pass, database
    $dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

    //BUILD THE query
    $query = "SELECT * FROM album_simple ORDER BY artist ASC";

    //NOW TRY AND TALK TO THE database
    $result = mysqli_query($dbconnection, $query) or die ('query failed');

    // DISPLAY WHAT WE FOUND
    while ($row = mysqli_fetch_array($result)) {
      echo '<p>';
      echo ' <a href="details.php?id='. $row['id'].'">'.$row['artist'] .', '. $row['album'].'</a> - <a href="update.php?id='.$row['id'].'">update</a>';
      echo '</p>';
    }
    ?>
  </body>
</html>
