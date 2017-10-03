<?php

$subject = $_POST[subject];
$message = $_POST[message];
$from = "landon@thecallfamily.com";

// BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect('localhost','dgm3760','Qwerpoiu1@','dgm3760') or die ('connection failed');

//BUILD THE QUERRY
$query = "SELECT * FROM newsletter";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('querry failed');

//DISPLAY WHAT WE found
while ($row = mysqli_fetch_array($result)) {
  $first_name = $row['first'];
  $last_name = $row['last'];
  $to = $row['email'];
  $body = "Dear $first_name $last_name, \n$message";

  mail($to, $subject, $body, 'from: '.$from);

  echo 'Message sent to ' . $to . '<br />';

};

//WE'RE DONE SO HANG UP
mysqli_close($dbconnection);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    You have sent email to your interested people.
  </body>
</html>
