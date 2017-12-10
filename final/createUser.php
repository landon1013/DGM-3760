<?php
require_once('variables.php');

  // Default message to user
  $feedback = '';

  $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

  // If the user isn't logged in, try to log them in
  if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($dbconnection, trim($_POST['name']));
    $username = mysqli_real_escape_string($dbconnection, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbconnection, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbconnection, trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      $query = "SELECT * FROM final_users WHERE username = '$username'";

      $alreadyexists = mysqli_query($dbconnection, $query) or die ('query failed');

      if (mysqli_num_rows($alreadyexists) == 0) {
        // INSERT the data
        $query = "INSERT INTO final_users (name, username, password, date, admin) VALUES ('$name', '$username', SHA('$password1'), NOW(), 0)";
        mysqli_query($dbconnection, $query) or die ('insert query failed');

        // CONFIRM MESSAGE
        $feedback = '<p>New user has been successfully created.</p><p>Return <a href="index.php">Home</a>.</p>';

        setcookie('name', $name, time() + (60*60*24*30));
        setcookie('username', $username, time() + (60*60*24*30));

        // Close the connection
        mysqli_close($dbconnection);

        // Redirect to the homepage
        header('Location: index.php');
      } else {
        $feedback = '<p class="error">An account already exists for this username. Please use a different name.</p>';
      } // end else
    } else {
      $feedback = 'please make sure passwords match and is not empty';
    } // end of empty check
  }// end POST
?>

<?php require_once('header.php'); ?>
    <title>New User</title>
  </head>
  <body>
    <h1>New User</h1>
    <?php echo $feedback; ?>
    <form method="post" action="createUser.php">
      <fieldset>
        <legend>Create New User</legend>
        <label><p>name:</p><input type="text" name="name" value="<?php if (!empty($name)) echo $name;?>" /></label>
        <label><p>Username:</p><input type="text" name="username" value="<?php if (!empty($username)) echo $username;?>" /></label>
        <label><p>Password</p><input type="password" name="password1" /></label>
        <label><p>Confirm Password</p><input type="password" name="password2" /></label>
      </fieldset>
      <input type="submit" value="Create User" name="submit" />
    </form>
    <p><a class="btn" href="index.php">Cancel</a></p>
  </body>
</html>
