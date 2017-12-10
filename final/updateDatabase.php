<?php
require_once('superProtect.php');
require_once('variables.php');

$id = $_POST['id'];
$title = $_POST['title'];
$rating = $_POST['rating'];
$description = $_POST['description'];

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

$description = mysqli_real_escape_string($dbconnection, $description);

//BUILD THE query
$query = "UPDATE final_movie SET title='$title', rating=$rating, description='$description' WHERE id=$id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');

$query = "SELECT * FROM final_rating where rating_id = $rating";
$resultRating = mysqli_query($dbconnection, $query) or die ('rating query failed');

$row2 = mysqli_fetch_array($resultRating);
?>

<?php require_once('header.php') ?>
    <title>Update Database</title>
  </head>
  <body>
    <?php
    // DELETE SELECTED RECORD (IN FROM POST)
    if (isset($_POST['submit'])) {
      echo '<div class="container">';
        echo '<h1>Movie successfuly updated</h1><br />';
        echo '<div class="confirmation">';
          echo '<div class="info">';
            echo 'Title: ' . $title . '<br /><br />';
            echo 'Rating: ' . $row2['value'] . '<br /><br />';
            echo 'Description: ' . $description;
          echo '</div>';
          echo '<br /><br /><a href="/final/"><button>Home</button></a>';
        echo '</div>';
      echo '</div>';
    };
    ?>
  </body>
</html>
