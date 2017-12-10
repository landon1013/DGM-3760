<?php
$id = $_GET['id'];

require_once('superProtect.php');
require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

//BUILD THE query
$query = "SELECT id, title, image, rating, description FROM final_movie WHERE id = $id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

$query = "SELECT * FROM final_rating ORDER BY value ASC";
$resultRating = mysqli_query($dbconnection, $query) or die ('rating query failed');
?>

<?php require_once('header.php'); ?>
    <title>Update Movie</title>
  </head>
  <body>
    <?php require_once('hero.php'); ?>
    <div class="container">
      <h1>Update Movie Info</h1>

      <? while ($row = mysqli_fetch_array($result)) { ?>
        <form method="post" action="updateDatabase.php" enctype="multipart/form-data">
          <fieldset>
            <legend>
              Movie Info
            </legend>

            <label>
              <p>Title:</p>
              <input type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="sales" required />
            </label>

            <label>
              <p>Rating:</p>
              <select name="rating">
                <option disabled>Please Select...</option>
                <?php
                while($row2 = mysqli_fetch_array($resultRating)) {
                  if ($row2['rating_id'] == $row['rating']) {
                    echo '<option selected value="' . $row2['rating_id'] . '">' . $row2['value'] . '</option>';
                  } else {
                    echo '<option value="' . $row2['rating_id'] . '">' . $row2['value'] . '</option>';
                  }
                };
                ?>
              </select>
            </label>


            <label>
              <p>Description:</p>
              <textarea name="description" maxlength="240" required><?php echo $row['description']; ?></textarea>
            </label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
          </fieldset>
          <input type="submit" value="Update Movie" name="submit" />
        </form>
      <?php } ?>
    </div> <!-- end container -->
  </body>
</html>
