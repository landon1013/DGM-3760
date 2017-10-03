<?php
$id = $_POST[id];
$album = $_POST[album];
$artist = $_POST[artist];
$tracks = $_POST[tracks];
$genre = $_POST[genre];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

//BUILD THE query
$query = "UPDATE album_simple SET album='$album', artist='$artist', tracks='$tracks', genre='$genre' WHERE id=51 ";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

//WE'RE DONE SO HANG UP
mysqli_close($dbconnection);

// DELSETE SELECTED RECORD (IN FROM POST)
if (isset($_POST['submit'])) {
  header("Location: http://3760.ljazzstudios.com/05-manageRecords/details.php?id=$id");
  exit;
};
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
