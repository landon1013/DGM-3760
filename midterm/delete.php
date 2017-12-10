<?
require_once('protect.php');

$id = $_GET[id];
$image = 'img/' . $_GET[image];

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

// DELSETE SELECTED RECORD (IN FROM POST)
if ($id) {
  $query = "DELETE FROM mid_employee WHERE id=$id";

  $result = mysqli_query($dbconnection, $query) or die ('delete query failed');

  @unlink($image);

  header("Location: http://3760.ljazzstudios.com/midterm/index.php");

  exit;
};
