<?php
$employee_id = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

//BUILD THE query
$query = "SELECT * FROM album_simple WHERE id=$employee_id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('select query failed');

// PUT THE RESULTS IN A VARIABLE
$found = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php include('nav.php'); ?>
    <h1>Update favorite album</h1>
    <form method="POST" action="updateDatabase.php" enctype="multipart/form-data">
      <fieldset>
        <legend>Album Info</legend>
        <label>Album Name:</label>
        <input type="text" name="album" value="<?php echo $found['album']; ?>" />
        <label>Artist Name:</label>
        <input type="text" name="artist" value="<?php echo $found['artist']; ?>" />
        <label>Number of Tracks:</label>
        <input type="text" name="tracks" value="<?php echo $found['tracks']; ?>" />
      </fieldset>

      <fieldset>
        <legend>Genre</legend>
        <label>Please Select</label>
        <select name="genre">
          <option><?php echo $found['genre']; ?></option>
          <option disabled>------------</option>
          <option>Alternative</option>
          <option>Blues</option>
          <option>Classical</option>
          <option>Country</option>
          <option>EDM</option>
          <option>Hard Rock</option>
          <option>Heavy Metal</option>
          <option>Pop</option>
          <option>Punk Rock</option>
          <option>Rap</option>
          <option>Rock n' Roll</option>
        </select>
      </fieldset>

      <!-- <fieldset>
        <legend>Artwork</legend>
        <label>Album Artwork</label>
        <input type="file" name="art" />
        <p>
          File must be saved as a .jpg file.<br />Please crop to 150px wide X 200px tall before uploading.
        </p>
      </fieldset> -->

      <input type="hidden" name="id" value="<?php echo $found['id'] ?>"  />
      <input type="submit" name="submit" value="Update Album" class="submitBtn" />
    </form>

  </body>
</html>
