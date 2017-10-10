<?php
$name = $_POST[name];
$topic = $_POST[topic];
$comment = $_POST[comment];
$date = date("Y-m-d");

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "INSERT INTO blog(name, topic, comment, date)".
  "VALUES ('$name','$topic','$comment','$date')";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

//RETURN TO THE APPROVE PAGE
header('Location: newEntry.php');
?>
