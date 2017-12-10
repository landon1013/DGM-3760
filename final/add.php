<?php
require_once('superProtect.php');
require_once('variables.php');

$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

// Get genre list from the database
$query = "SELECT * FROM final_movie";
$result = mysqli_query($dbconnection, $query) or die ('movie query failed');

// Get games from the database
$query = "SELECT * FROM final_rating ORDER BY value ASC";
$resultRating = mysqli_query($dbconnection, $query) or die ('rating query failed');
?>

<?php require_once('header.php'); ?>
    <title>Add New Movie</title>
  </head>
  <body>
    <?php require_once('hero.php'); ?>
    <div class="container">
      <h1>New Movie</h1>

      <form method="post" action="movie-thanks.php" enctype="multipart/form-data">
        <fieldset>
          <legend>
            Movie Info
          </legend>
          <label>
            <p>Title:</p>
            <input type="text" name="title" value="" placeholder="Toy Story" required />
          </label>

          <label>
            <p>Rating:</p>
            <select name="rating">
              <option selected disabled>Please Select...</option>
              <?php
              while($row = mysqli_fetch_array($resultRating)) {
                echo '<option value="' . $row['rating_id'] . '">' . $row['value'] . '</option>';
              };
              ?>
            </select>
          </label>

          <label>
            <p>Movie Poster:</p>
            <input type="file" name="image" value="" required />
          </label>

          <label>
            <p>About Movie:</p>
            <textarea name="description" maxlength="240" required></textarea>
          </label>
        </fieldset>
        <input type="submit" value="Add Movie" name="submit" />
      </form>
    </div> <!-- end container -->
  </body>
</html>
