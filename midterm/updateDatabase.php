<?php
require_once('protect.php');

$id = $_POST[id];
$name = $_POST[name];
$title = $_POST[title];
$phone = $_POST[phone];
$email = $_POST[email];
$about = $_POST[about];

require_once('variables.php');

if ($_FILES["image"]["size"] == 0) {
  //BUILD THE DATABASE CONNECTION WITH host, user, pass, database
  $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

  //BUILD THE query
  $query = "UPDATE mid_employee SET name='$name', title='$title', phone='$phone', email='$email', about='$about' WHERE id=$id";

  //NOW TRY AND TALK TO THE database
  $result = mysqli_query($dbconnection, $query) or die ('query failed');

  //WE'RE DONE SO HANG UP
  mysqli_close($dbconnection);

  if (isset($_POST['submit'])) {
    header("Location: http://3760.ljazzstudios.com/midterm/details.php?id=$id");
    exit;
  } // end if
} else {
  // Make Photo path and name
  $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

  $image_name = str_replace(' ', '_', $name);
  $image_name = strtolower($image_name);
  $filename = $image_name.time() . '.' . $ext;
  $filepath = 'img/';
  ?>
  <?php require_once('header.php') ?>
      <title>Update Database</title>
    </head>
    <body>
      <?php
      if ($filename) {
        // VARIFY THE IMAGE IS VALID
        $validImage = true;

        if ($_FILES['image']['size'] > 2048000) {
          echo 'File can\'t be larger than 2MB';
          $validImage = false;
        }

        if ($_FILES['image']['type'] == 'image/gif' || $_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/pjpeg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['size'] == 0) {

        } else {
          echo 'The image must be .jpg .gif or .png';
          $validImage = false;
        }

        if ($validImage == true && $filename == true) {
          // Upload the file
          $tmp_name = $_FILES['image']['tmp_name'];
          move_uploaded_file($tmp_name, "$filepath$filename");
          @unlink($_FILES['image']['tmp_name']);

          //BUILD THE DATABASE CONNECTION WITH host, user, pass, database
          $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

          //BUILD THE query
          $query = "UPDATE mid_employee SET name='$name', title='$title', phone='$phone', email='$email', image='$filename', about='$about' WHERE id=$id";

          //NOW TRY AND TALK TO THE database
          $result = mysqli_query($dbconnection, $query) or die ('query failed');

          //WE'RE DONE SO HANG UP
          mysqli_close($dbconnection);

          // DELETE SELECTED RECORD (IN FROM POST)
          if (isset($_POST['submit'])) {
            echo '<div class="container">';
              echo '<h1>Employee Spotlight successfuly updated</h1><br / />';
              echo '<div class="confirmation">';
                echo '<div class="info">';
                  echo 'Name: ' . $name;
                  echo '<br />Title: ' . $title;
                  echo '<br />Phone #: ' . $phone;
                  echo '<br />Email: ' . $email;
                echo '</div>';
                echo '<br /><img src="'.$filepath.$filename.'" alt="photo" />';
                echo '<br /><br /><a href="/midterm/details.php?id=' . $_POST[id] . '"><button>Back</button></a>';
              echo '</div>';
            echo '</div>';
          };

        } else if ($image_name == false){
          // Try again
          $validImage = false;
          echo 'Please fill out all fields';
          echo '<br /><a href="/midterm/update.php?id=' . $row[id] . '"><button>Please try again</button></a>';
        }
        else {
          echo '<br /><a href="/midterm/update.php?id=' . $row[id] . '"><button>Please try again</button></a>';
        }
      }
    }
    ?>
  </body>
</html>
