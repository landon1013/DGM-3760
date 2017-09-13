<?php

  $firstname = $_REQUEST['firstname'];
  $lastname = $_REQUEST['lastname'];
  $email = $_REQUEST['email'];
  $other = $_REQUEST['other'];
  $date = $_REQUEST['date'];
  $subscribe = $_REQUEST['subscribe'];

  $to = "landon@thecallfamily.com"; //recipient

  $subject = "VR Junkies help form"; //subject
  $body = $firstname . " " . $lastname . " is requestion help. Contact them at " . $email . "\n" . "How can we help? " . $other . "\n" . "When can we contact you? " . $date . "\n" . "Would you like to subscribe? " . $subscribe;
  $header = "From: ". $firstname . " " . $lastname . " <" . $email . ">\r\n";

  if (mail($to, $subject, $body, $header)){
    include'thanks.php';
  } else {
    echo 'Error: something went wrong.';
  }

?>
