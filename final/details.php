<?php
$id = $_GET['id'];
$username = $_COOKIE['username'];

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "SELECT id, title, rating, description, image FROM final_movie WHERE id = $id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');


if(isset($_POST['submit'])) {

  //BUILD THE query

  $userQuery = "SELECT id, username FROM final_users WHERE username = '$username'";

  //Now try and talk to the database
  $userResult = mysqli_query($dbconnection, $userQuery) or die ('user query failed');

  while($user = mysqli_fetch_array($userResult)) {
    $userid = $user['id'];
    $username = $user['username'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $comment = mysqli_real_escape_string($dbconnection, $comment);

    $commentQuery = "INSERT INTO final_comment (movie_id, user_id, rating, comment) VALUES ($id, $userid, $rating, '$comment')";

    $commentResult = mysqli_query($dbconnection, $commentQuery) or die ('comment query failed');
  }
}
?>
<?php require_once('header.php'); ?>
  <title>Details</title>
</head>
<body>
  <?php require_once('hero.php'); ?>
  <div class="container">
    <?php
    while ($row = mysqli_fetch_array($result)) {
      echo '<h1>' . $row['title'] . '</h1>';
      echo '<div class="movie details">';
        echo '<img src="img/' . $row['image'] . '" alt="profile picture" />';

        $theid = $row['id'];

        // Build the query for an inner join
        $query2 = "SELECT * FROM final_movie INNER JOIN final_rating ON (final_movie.rating = final_rating.rating_id) WHERE id = $theid";

        // Now try and talk to the database
        $resultRating = mysqli_query($dbconnection, $query2) or die ('game query failed');

        while ($row2 = mysqli_fetch_array($resultRating)) {
          echo '<p><span>Rating:</span> ' . $row2['value'] . '</p>';
        };
        echo '<p><span>About:</span> ' . $row['description'] . '</p>';
        if (isset($_COOKIE['username'])) {
          echo '<div class="flex">';
            require_once('superadmin.php');
          echo '</div>';
        }
      echo '</div>';
    }
    ?>

    <?php
    if (isset($_COOKIE['username'])) { ?>
      <form class="comment" method="post" action="details.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <fieldset>
          <legend>
            Comment
          </legend>
          <label>Leave a Comment</label>
          <textarea name="comment"></textarea><br />
          <label>Rating</label><br />
          <label>1<input type="radio" name="rating" value="1" /></label>
          <label>2<input type="radio" name="rating" value="2" /></label>
          <label>3<input type="radio" name="rating" value="3" /></label>
          <label>4<input type="radio" name="rating" value="4" /></label>
          <label>5<input type="radio" name="rating" value="5" /></label>
          <br />
          <input type="submit" name="submit" value="submit" />
        </fieldset>
      </form>
    <?php } ?>

    <?php
    $showCommentQuery = "SELECT * FROM final_comment WHERE movie_id = $id";

    // Now try and talk to the database
    $showCommentResult = mysqli_query($dbconnection, $showCommentQuery) or die ('show comment query failed');

    while($comment = mysqli_fetch_array($showCommentResult)) {
      $user_id = $comment['user_id'];

      $commentorQuery = "SELECT username FROM final_users WHERE id = $user_id";

      $commentorResult = mysqli_query($dbconnection, $commentorQuery) or die ('commentor query failed');

      echo '<div class="userComment">';
        while($username = mysqli_fetch_array($commentorResult)) {
          echo '<h2>' . $username['username'] . '</h2>';
        }

        echo '<p>Rating: ' . $comment['rating'] . '/5</p>';
        echo '<p>Comment:<br />' . $comment['comment'] . '</p>';
      echo '</div>';
    }
    ?>
  </div>
</body>
</html>
