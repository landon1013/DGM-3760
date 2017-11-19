<?php
  // Delete the cookies by setting their experations to an hour ago (3600)
  setcookie('username', '', time()-3600 );
  setcookie('firstname', '', time()-3600 );
  setcookie('lastname', '', time()-3600 );

  // Redirect to the homepage
  header('Location: index.php');
?>
