<?php
require_once('variables.php');

// Connect to the database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

// Get genre list from the database
$query = "SELECT * FROM genre08 ORDER BY value ASC";
$resultGenre = mysqli_query($dbconnection, $query) or die ('genre query failed');

// Get games from the database
$query = "SELECT * FROM games08 ORDER BY value ASC";
$resultGames = mysqli_query($dbconnection, $query) or die ('game query failed');


?>

<!DOCTYPE html>
<html>
  <?php require_once('header.php'); ?>
  <body>
    <?php require_once('nav.php'); ?>

    <div class="container">
      <h1>Add a New Gamer</h1>

      <form method="POST" action="saveToDatabase.php">

        <fieldset>
          <legend>Personal Information</legend>
          <label>
            <p>First Name:</p>
            <input type="text" name="firstname" placeholder="first name" pattern="[a-zA-Z]{3-99}" required />
          </label>

          <label>
            <p>Last Name:</p>
            <input type="text" name="lastname" placeholder="last name" pattern="[a-zA-Z]{3-99}" required />
          </label>

          <label>
            <p>Gamertag:</p>
            <input type="text" name="gamertag" placeholder="gamertag" required />
          </label>
        </fieldset>

        <fieldset>
          <legend>Gender</legend>
            <label><input type="radio" name="gender" value="1" /> <span>Male</span></label>
            <label><input type="radio" name="gender" value="2" /> <span>Female</span></label>
        </fieldset>

        <fieldset>
          <legend>Favorite Genre</legend>
          <label>
            <p>Please Select a Genre</p>
            <select name="genre">
              <option selected disabled>Please Select...</option>
              <?php
              while($row = mysqli_fetch_array($resultGenre)) {
                echo '<option value="' . $row['genre_id'] . '">' . $row['value'] . '</option>';
              };
              ?>
            </select>
          </label>
        </fieldset>

        <fieldset>
          <legend>Your Games</legend>
          <label>
            <p>Check games you own</p>
            <div class="flex checkboxContainer">
              <?php
              while($row = mysqli_fetch_array($resultGames)) {
                echo '<label><input type="checkbox" value="' . $row['game_id'] . '" name="games[]" />' . $row['value'] . '</label>';
              };
              ?>
            </div>
          </label>
        </fieldset>
        <input type="submit" name="submit" value="Add Gamer" />
      </form>
    </div>
  </body>
</html>
