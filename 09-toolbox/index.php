<?php
require_once('variables.php');

// Connect to the database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

// Build the query for an inner join
$query = "SELECT * FROM skills09 ORDER BY name ASC";

// Now try and talk to the database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

// function to turn a month day into a month name
function convertMonth($a) {
  switch($a) {
    case  1:
    $b = "January";
    break;
    case 2:
    $b = "February";
    break;
    case 3:
    $b = "March";
    break;
    case 4:
    $b = "April";
    break;
    case 5:
    $b = "May";
    break;
    case 6:
    $b = "June";
    break;
    case 7:
    $b = "July";
    break;
    case 8:
    $b = "August";
    break;
    case 9:
    $b = "September";
    break;
    case 10:
    $b = "October";
    break;
    case 11:
    $b = "November";
    break;
    case 12:
    $b = "December";
    break;
  } // End the case;
  return $b;
} // end function
?>

<!DOCTYPE html>
<html>
  <?php include_once('header.php'); ?>
  <body>
    <?php include_once('nav.php'); ?>
    <div class="container">
      <h1>Potential Employee Directory</h1>

      <?php
      // Display what we found
      while ($row = mysqli_fetch_array($result)) {
        $day = substr($row[birthday], 0, 2);
        $monthNum = substr($row[birthday], 3, 2);
        $monthName = convertMonth($monthNum); //calls a function
        $year = substr($row[birthday], 6, 4);

        echo '<h2>' . $row[name] . '</h2>';
        echo '<p>Birthday is ' . $monthName . ' ' . $day . ', ' . $year . '</p>';
        echo '<p>' . $row[skills] . '</p>';
        echo '<hr />';
      };

      // We're done so hang up
      mysqli_close($dbconnection);
      ?>
    </div>
  </body>
</html>
