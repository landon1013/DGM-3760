<?php
require_once('protect.php');
require_once('variables.php');

$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

if (isset($_POST['submitAdmin'])) {
  $name = mysqli_real_escape_string($dbconnection, trim($_POST['name']));
  $username = mysqli_real_escape_string($dbconnection, trim($_POST['username']));
  $password1 = mysqli_real_escape_string($dbconnection, trim($_POST['password1']));
  $password2 = mysqli_real_escape_string($dbconnection, trim($_POST['password2']));

  if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {


    $query = "SELECT * FROM mid_user WHERE username = '$username'";
    $alreadyexists = mysqli_query($dbconnection, $query) or die ('query failed');

    if (mysqli_num_rows($alreadyexists) == 0) {
      // INSERT the data
      $query = "INSERT INTO mid_user (name, username, password, date) VALUES ('$name', '$username', SHA('$password1'), NOW() )";
      mysqli_query($dbconnection, $query) or die ('insert query failed');

      // CONFIRM MESSAGE
      $feedback = '<p>New admin account has been successfully created.</p><p>Return <a href="index.php">Home</a>.</p>';

      // Close the connection
      mysqli_close($dbconnection);

      // exit the page
      // exit();
    } else {
      $feedback = '<p class="error">An account already exists for this username. Please use a different name.</p>';
    } // end else
  } else {
    $feedback = 'please make sure passwords match and is not empty';
  } // end of empty check
} // end
?>

<?php require_once('header.php'); ?>
    <title>Add New People</title>
  </head>
  <body>
    <?php require_once('hero.php'); ?>
    <div class="container">
      <?php
  echo $feedback . '<br /><br />';
  if ($feedback == '<p>New admin account has been successfully created.</p><p>Return <a href="index.php">Home</a>.</p>') {
    exit();
  }
  ?>
      <h1>New Employee Spotlight</h1>

      <form method="post" action="employee-thanks.php" enctype="multipart/form-data">
        <fieldset>
          <legend>
            Employee Info
          </legend>
          <label>
            <p>Name:</p>
            <input type="text" name="name" value="" placeholder="John Smith" required />
          </label>

          <label>
            <p>Title:</p>
            <input type="text" name="title" value="" placeholder="sales" required />
          </label>

          <label>
            <p>Phone #:</p>
            <input type="tel" name="phone" value="" pattern="\d{3}[\-]\d{3}[\-]\d{4}" placeholder="555-123-1234" required />
          </label>

          <label>
            <p>Email:</p>
            <input type="email" name="email" value="" placeholder="john@gmail.com" required />
          </label>

          <label>
            <p>Profile Picture:</p>
            <input type="file" name="image" value="" required />
          </label>

          <label>
            <p>Spotlight info:</p>
            <textarea name="about" maxlength="240" required></textarea>
          </label>
        </fieldset>
        <input type="submit" value="Add Employee" name="submit" />
      </form>
      <?php require_once('superadmin.php') ?>
    </div> <!-- end container -->
  </body>
</html>
