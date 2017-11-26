<?php
require_once('variables.php');
$queryaddition = '';

if (isset($_GET[genre])) {
  $queryaddition = "WHERE genre = $_GET[genre]";
}

// Connect to the database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

// Build the query for an inner join
$query = "SELECT * FROM gamer08 INNER JOIN genre08 ON (gamer08.genre = genre08.genre_id) $queryaddition ORDER BY lastname";

// Now try and talk to the database
$result = mysqli_query($dbconnection, $query) or die ('query failed');
?>

<!DOCTYPE html>
<html>
  <?php include_once('header.php'); ?>
  <body>
    <?php include_once('nav.php'); ?>
    <div class="container">
      <?php
      // Display what we found
      if(mysqli_num_rows($result) == 0) {
        echo'<p>Sorry but no one matches your requested search.</p>';
      }
      while($row = mysqli_fetch_array($result)) {
        echo '<div class="gamer">';
        echo '<h2>' . $row['firstname'] . ' ' . $row['lastname'] . '</h2>';
        echo '<p>';
        // Ternary operator -- replaces an if else
        echo ($row['gender'] == 1 ? 'Mr. ' : 'Ms. ') . $row['lastname'];
        echo ' is a gamer who favors ' . $row['value'] . ' games.</p>';

        echo '<p>';
        echo ($row['gender'] == 1 ? 'He ' : 'She ');
        echo 'owns the following games:</p>';

        // Assign the user id to a variable to be used in the next query
        $theid = $row['id'];

        // Build the query for an inner join
        $query2 = "SELECT * FROM library08 INNER JOIN games08 ON (library08.games_id = games08.game_id) WHERE id = $theid";

        // Now try and talk to the database
        $resultGame = mysqli_query($dbconnection, $query2) or die ('game query failed');

        while ($row2 = mysqli_fetch_array($resultGame)) {
          echo '<p class="games">' . $row2['value'] . '</p>';
        };
        echo '</div>';
      };
      ?>
    </div>
  </body>
</html>
