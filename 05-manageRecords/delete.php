<?php
$employee_id = $_GET[id];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

// DELSETE SELECTED RECORD (IN FROM POST)
if (isset($_POST['submit'])) {
  $query = "DELETE FROM album_simple WHERE id=$_POST[id]";

  $result = mysqli_query($dbconnection, $query) or die ('delete query failed');

  @unlink($_POST['art']);

  header("Location: http://3760.ljazzstudios.com/05-manageRecords/deleteFromDatabase.php");

  exit;
};

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
    <title>Album Detail</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <h1>Deleting an Album!</h1>
    <div class="album">
      <form action="delete.php" method="POST">
        <?php
        echo '<h2>'.$found['album'] .' by '. $found['artist'].'</h2>';
        echo '<p>';
        echo '# of tracks: '.$found['tracks'].'<br />'. 'Genre: '.$found['genre'];
        echo '</p>';
        ?>

        <input type="hidden" name="art" value="artwork/<?php echo $found['art']; ?>" />
        <input type="hidden" name="id" value="<?php echo $found['id']; ?>" />
        <input type="submit" name="submit" value="DELETE ALBUM" />
        &nbsp; <a href="deleteFromDatabase.php">Cancel</a>
      </form>
    </div>
  </body>
</html>
