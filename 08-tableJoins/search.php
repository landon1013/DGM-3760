<?php
require_once('variables.php');
// Connect to the database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

// Get genre list from the database
$query = "SELECT * FROM genre08 ORDER BY value ASC";
$resultGenre = mysqli_query($dbconnection, $query) or die ('genre query failed');
?>

<!DOCTYPE html>
<html>
  <?php include_once('header.php'); ?>
  <body>
    <?php include_once('nav.php'); ?>
    <h2>Search by genre</h2>
    <ul class="searchList">
      <?php
      while($row = mysqli_fetch_array($resultGenre)) {
        echo '<a href="index.php?genre=' . $row['genre_id'] . '"><li>' . $row['value'] . '</li></a>';
      };
      ?>
    </ul>
  </body>
</html>
