<?php
if (isset($_POST['submit'])) {
  // LOAD the post data into PHP variables
  $name = $_POST[name];
  $skills = $_POST[skills];
  $day = $_POST[day];
  $month = $_POST[month];
  $year = $_POST[year];

  $birthday = $day . '_' . $month . '_' . $year;

  require_once('variables.php');

  // Connect to the database
  $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

  // Add user to database
  $query = "INSERT INTO skills09 (name, birthday, skills) VALUES ('$name', '$birthday', '$skills')";

  // Now try and talk to the database
  $result = mysqli_query($dbconnection, $query) or die ('querry failed');

  // We are done
  mysqli_close($dbconnection);

  header('Location: index.php');
  exit;
} // end isset
?>

<!DOCTYPE html>
<html>
  <?php require_once('header.php'); ?>
  <body>
    <?php require_once('nav.php'); ?>

    <div class="container">
      <h1>Get Discovered</h1>

      <form method="POST" action="add.php" enctype="multipart/form-data" name="skillsInfo">

        <fieldset>
          <legend>Required Information</legend>
          <label>
            <p>Name:</p>
            <input type="text" name="name" placeholder="full name" pattern="[a-zA-Z- ]{3-99}" required />
          </label>

          <label>
            <p>Birthday</p>
            <select name="day">
              <option disabled selected>Day</option>
              <?php
              for ($i = 1; $i <= 31; $i++) {
                echo '<option>' . sprintf("%02d", $i) . '</option>';
              }
              ?>
            </select>

            <select name="month">
              <option disabled selected>Month</option>
              <?php
              for ($i = 1; $i <= 12; $i++) {
                echo '<option>' . sprintf("%02d", $i) . '</option>';
              }
              ?>
            </select>

            <input name="year" value="" type="text" placeholder="1989" pattern="[0-9]{4}" required class="year" />
          </label>

          <label>
            <p>Please list your skills</p>
            <textarea name="skills"></textarea>
          </label>
        </fieldset>

        <input type="submit" name="submit" value="Add Skills" />
      </form>
    </div>
  </body>
</html>
