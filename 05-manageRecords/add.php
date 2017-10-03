<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Manage</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php include('nav.php'); ?>
    <h1>Add new favorite album</h1>
    <form method="POST" action="sendToDatabase.php" enctype="multipart/form-data">
      <fieldset>
        <legend>Album Info</legend>
        <label>Album Name:</label>
        <input type="text" name="album" value="" placeholder="Wrecking Ball" />
        <label>Artist Name:</label>
        <input type="text" name="artist" value="" placeholder="Miley Cyrus" />
        <label>Number of Tracks:</label>
        <input type="text" name="tracks" value="" placeholder="1" />
      </fieldset>

      <fieldset>
        <legend>Genre</legend>
        <label>Please Select</label>
        <select name="genre">
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

      <fieldset>
        <legend>Artwork</legend>
        <label>Album Artwork</label>
        <input type="file" name="art" />
        <p>
          File must be saved as a .jpg file.<br />Please crop to 150px wide X 200px tall before uploading.
        </p>
      </fieldset>

      <input type="submit" name="submit" value="Add Album" class="submitBtn" />
    </form>

  </body>
</html>
