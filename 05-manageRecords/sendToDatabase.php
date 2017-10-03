<?php
$album = $_POST[album];
$artist = $_POST[artist];
$tracks = $_POST[tracks];
$genre = $_POST[genre];
$art = $_POST[art];

// Make Photo path and name
$ext = pathinfo($_FILES['art']['name'], PATHINFO_EXTENSION);

$artist_new = str_replace(' ', '', $artist);
$album_new = str_replace(' ', '', $album);

$filename = $artist_new.'_'.$album_new.time().'.'.$ext;
$filepath = 'artwork/';
//echo $filename;

// VARIFY THE IMAGE IS VALID
$validImage = true;

if ($_FILES['art']['size'] == 0) {
  echo 'Please upload the album artwork';
  $validImage = false;
};

if ($_FILES['art']['size'] > 204800) {
  echo 'File can\'t be larger than 200KB';
  $validImage = false;
}

if ($_FILE['art']['type'] == 'image/gif' || $_FILES['art']['type'] == 'image/jpeg' || $_FILES['art']['type'] == 'image/pjpeg' || $_FILES['art']['type'] == 'image/png' || $_FILES['art']['size'] == 0) {

} else {
  echo 'The image must be .jpg .gif or .png';
  $validImage = false;
}

if ($validImage == true && $artist_new == true && $album_new == true) {
  // Upload the file
  $tmp_name = $_FILES['art']['tmp_name'];
  move_uploaded_file($tmp_name, "$filepath$filename");
  @unlink($_FILES['art']['tmp_name']);

  //BUILD THE DATABASE CONNECTION WITH host, user, pass, database
  $dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

  //BUILD THE query
  $query = "INSERT INTO album_simple(album, artist, tracks, genre, art)".
  "VALUES ('$album','$artist','$tracks','$genre','$filename')";

  //NOW TRY AND TALK TO THE database
  $result = mysqli_query($dbconnection, $query) or die ('query failed');

  //WE'RE DONE SO HANG UP
  mysqli_close($dbconnection);

  if ($validImage == true) {
    echo '<h1>Album successfuly added</h1><br / />';
    echo 'Album: ' . $album . ', Performed by: ' . $artist;
    echo '<br /># of tracks: ' . $tracks . ', Genre: ' . $genre;
    echo '<br /><img src="'.$filepath.$filename.'" alt="photo" />';
    echo '<br /><br /><a href="/05-manageRecords/"><button>Back</button></a>';
  }

} else if ($artist_new == false || $album_new == false){
  // Try again
  $validImage = false;
  echo 'Please fill out all fields';
  echo '<br /><a href="/05-manageRecords/"><button>Please try again</button></a>';
}
else {
  echo '<br /><a href="/05-manageRecords/"><button>Please try again</button></a>';
}

?>
