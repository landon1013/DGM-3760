<?php
require_once('authorize.php');

$id = $_GET['id'];

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "UPDATE blog SET approved=1 WHERE id=$id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

//RETURN TO THE APPROVE PAGE
header('Location: approve.php');
?>
