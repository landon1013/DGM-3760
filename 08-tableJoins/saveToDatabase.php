<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$gamertag = $_POST['gamertag'];
$gender = $_POST['gender'];
$genre = $_POST['genre'];

require_once('variables.php');

// Connect to the database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

// Build the query
$query = "INSERT INTO gamer08 (firstname, lastname, gamertag, gender, genre) VALUES ('$firstname', '$lastname', '$gamertag', '$gender', '$genre')";

// Now try and talk to the database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

// Update gamer's library
// This is the id of the user just added
$recent_id = mysqli_insert_id($dbconnection);

// Loop through the array that contains all the games they selected
foreach($_POST['games'] as $games_id) {
  $query = "INSERT INTO library08 (id, games_id) VALUES ($recent_id, $games_id)";

  // Now try and update the record
  $result = mysqli_query($dbconnection, $query) or die ('update games library query failed');
}; // End foreach

// We're done so hang up
mysqli_close($dbconnection);
?>

<!DOCTYPE html>
<html>
  <?php require_once('header.php'); ?>
  <body>
    <?php include_once('nav.php'); ?>
    <div class="container">
      <p>An entry for <?php $firstname . ' ' . $lastname ?> has been added to the Gamer database.</p>
      <a href="new.php"><div class="btn">Add another gamer</div></a>
      <a href="index.php"><div class="btn">Return to the home page</div></a>
    </div>
  </body>
</html>
