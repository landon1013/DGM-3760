<?php
$id = $_GET['id'];

require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "SELECT id, name, title, phone, email, about, image FROM mid_employee WHERE id = $id";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');
?>
<?php require_once('header.php'); ?>
  <title>Details</title>
</head>
<body>
  <?php require_once('hero.php'); ?>
  <div class="container">
    <?php
    while ($row = mysqli_fetch_array($result)) {
      echo '<h1>' . $row['name'] . '</h1>';
      echo '<div class="employee details">';
        echo '<img src="img/' . $row['image'] . '" alt="profile picture" />';
        echo '<p><span>Title:</span> ' . $row['title'] . '</p>';
        echo '<p><span>Phone:</span> ' . $row['phone'] . '</p>';
        echo '<p><span>Email:</span> ' . $row['email'] . '</p>';
        echo '<p><span>About:</span> ' . $row['about'] . '</p>';
        if (isset($_COOKIE['username'])) {
          echo '<div class="flex">';
            echo '<a href="update.php?id=' . $row['id'] . '"><div class="btn">Update</div></a>';
            require_once('superadmin.php');
          echo '</div>';
        }
      echo '</div>';
    }
    ?>
  </div>
</body>
</html>
