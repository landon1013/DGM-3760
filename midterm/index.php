<?php
require_once('variables.php');

//BUILD THE DATABASE CONNECTION WITH host, user, pass, database
$dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection failed');

//BUILD THE query
$query = "SELECT id, name, title, phone, email, about, image FROM mid_employee ORDER BY title";

//NOW TRY AND TALK TO THE database
$result = mysqli_query($dbconnection, $query) or die ('query failed');
?>

<?php require_once('header.php'); ?>
<title>Employee Spotlight</title>
</head>
<body>
  <?php require_once('hero.php'); ?>
  <div class="container">
    <h1>Employee Spotlight</h1>
    <div class="flex">
      <?php
      while ($row = mysqli_fetch_array($result)) {
        echo '<div class="employee">';
          echo '<div class="profile" style="background-image: url(img/' . $row['image'] . ')"></div>';
          echo '<h2>' . $row['name'] . '</h2>';
          echo '<p><span>Title:</span> ' . $row['title'] . '</p>';
          echo '<a href="details.php?id=' . $row['id'] . '" ><div class="btn">More Info</div></a>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</body>
</html>
