<?php
require_once('variables.php');

  // Default message to user
  $feedback = '';

  // If the user isn't logged in, try to log them in
  if (isset($_POST['submit'])) {
    $dbconnection = mysqli_connect(HOST, USER, PASSWORD, DB_NAME) or die ('no dtabase connection');

    $username = mysqli_real_escape_string($dbconnection, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbconnection, trim($_POST['password']));

    // Look up the username and password in the database
    $query = "SELECT * FROM final_users WHERE username = '$username' AND password = SHA('$password')";
    $data = mysqli_query($dbconnection, $query) or die ('query failed');

    if (mysqli_num_rows($data) == 1) {
      $row = mysqli_fetch_array($data);

      // Save the cookie
      setcookie('username', $row['username'], time() + (60*60*24*30));
      setcookie('name', $row['name'], time() + (60*60*24*30));

      header('Location: index.php');
    } else {
      $feedback = '<p>Could not find an account for ' . $_POST['username'] . ' with that password. Would you like to <a href="signup.php">create a new account</a>?</p>';
    }// end if
  }// end POST
?>

<?php require_once('header.php'); ?>
    <title>Login</title>
  </head>
  <body>
    <h1>Log In</h1>
    <?php echo $feedback; ?>
    <form method="post" action="login.php">
      <fieldset>
        <legend>Log in to an existing account</legend>
        <label><p>Username:</p><input type="text" name="username" value="<?php if (!empty($username)) echo $username;?>" /></label>
        <label><p>Password</p><input type="password" name="password" /></label>
      </fieldset>
      <input type="submit" value="Log In" name="submit" />
      <a href="createUser.php">Create User</a>
    </form>
    <p><a class="btn" href="index.php">Cancel</a></p>
  </body>
</html>
