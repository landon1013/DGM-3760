<?php
$id = $_GET['id'];

require_once('protect.php');
require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

//BUILD THE query
$query = "SELECT id, name, title, phone, email, image, about FROM mid_employee WHERE id = $id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');
?>

<?php require_once('header.php'); ?>
    <title>Update People</title>
  </head>
  <body>
    <?php require_once('hero.php'); ?>
    <div class="container">
      <h1>Update Employee Spotlight</h1>

      <? while ($row = mysqli_fetch_array($result)) { ?>
        <form method="post" action="updateDatabase.php" enctype="multipart/form-data">
          <fieldset>
            <legend>
              Employee Info
            </legend>
            <label>
              <p>Name:</p>
              <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="John Smith" required />
            </label>

            <label>
              <p>Title:</p>
              <input type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="sales" required />
            </label>

            <label>
              <p>Phone #:</p>
              <input type="tel" name="phone" value="<?php echo $row['phone']; ?>" pattern="\d{3}[\-]\d{3}[\-]\d{4}" placeholder="555-123-1234" required />
            </label>

            <label>
              <p>Email:</p>
              <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="john@gmail.com" required />
            </label>

            <label>
              <p>Profile Picture:</p>
              <input type="file" name="image" value="" />
            </label>

            <label>
              <p>Spotlight info:</p>
              <textarea name="about" maxlength="240" required><?php echo $row['about']; ?></textarea>
            </label>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
          </fieldset>
          <input type="submit" value="Update Employee" name="submit" />
        </form>
      <?php } ?>
    </div> <!-- end container -->
  </body>
</html>
