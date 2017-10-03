<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delete</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <form method="POST" action="<?php $SERVER['PHP_SELF']; ?>">
      <fieldset>
        <legend>Deleting Users</legend>
        <p>
          Please select the people to delete
        </p>

        <?php
        // BUILD THE DATABASE CONNECTION WITH host, user, pass, database
        $dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

        // DELETE SELECTED RECORDS
        if(isset($_POST['submit'])) {
          foreach($_POST['todelete'] as $delete_id) {
            // echo $delete_id;
            $query = "DElete from newsletter WHERE id=$delete_id";

            // NOW TRY AND TALK TO THE DATABASE
            $result = mysqli_query($dbconnection, $query) or die ('query failed');
          };
        };

        // BUILD THE SELECT QUERRY
        $query = "SELECT * FROM newsletter";

        // NOW TRY AND TALK TO THE DATABASE
        $result = mysqli_query($dbconnection, $query) or die ('query failed');

        // DISPLAY WHAT WE WANT
        while ($row = mysqli_fetch_array($result)) {
          echo '<label>';
          echo '<input type="checkbox" value="'.$row['id'].'" name="todelete[]" />';
          echo $row['first'] . ' ' . $row['last'] . ' - ' . $row['email'];
          echo '</label>';
        };

        // WE'RE DONE SO HANG UP
        mysqli_close($dbconnection);

        ?>
        <input type="submit" name="submit" value="Delete User" class="submitBtn" />
      </fieldset>
    </form>

  </body>
</html>
