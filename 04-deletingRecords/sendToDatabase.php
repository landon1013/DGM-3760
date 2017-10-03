<?php
$firstname = $_POST[firstname];
$lastname = $_POST[lastname];
$email = $_POST[email];

// BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

//BUILD THE QUERRY
$query = "INSERT INTO newsletter(first, last, email)".
"VALUES ('$firstname','$lastname','$email')";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('querry failed');

//WE'RE DONE SO HANG UP
mysqli_close($dbconnection);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Thanks Page</title>
  </head>
  <body>
    Thank you for subscribing.
    <a href="/03-sendingSpam/"><button>Back</button></a>
  </body>
</html>
