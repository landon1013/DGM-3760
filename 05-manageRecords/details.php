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
    <title>Album Detail</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <?php include('nav.php'); ?>
    <h1>Detail information about an Album!</h1>
    <div class="album">
      <form class="details" action="delete.php" method="POST">
        <?php
        echo '<img class="artwork" src="artwork/'.$found['art'].'" alt="album artwork"';
        echo '<h2>'.$found['album'] .' by '. $found['artist'].'</h2>';
        echo '<p>';
        echo '# of tracks: '.$found['tracks'].'<br />'. 'Genre: '.$found['genre'];
        echo '</p>';
        ?>
      </form>
    </div>
  </body>
</html>
