<header>
  <img src="img/logo.jpeg" alt="logo" />
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <?php
      if(isset($_COOKIE['username'])) {
        $user = $_COOKIE['username'];
        require_once('variables.php');

        $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

        $admin_query = "SELECT id, name, username, admin FROM final_users WHERE username = '$user'";

        $admin_result = mysqli_query($dbconnection, $admin_query) or die ('query failed');

        while ($row2 = mysqli_fetch_array($admin_result)) {
          if ($row2['admin'] == 1) {
            echo '<li><a href="add.php">Add</a></li>';
          }
        }
      };
      ?>
      <li><a href="search.php">Search</a></li>
    </ul>
    <div class="login">
      <?php
      if (isset($_COOKIE['username'])) {
        echo '<p>Hello, ' . $_COOKIE['name'];
        echo ' | <a class="login" href="logout.php">signout</a></p>';
      } else {
        echo '<p><a class="login" href="login.php">login</a></p>';
      } // End if
      ?>
    </div>
  </nav>
</header>

<?php
$homeurl = '/final/index.php';
$homepage = '/final/';
$thankspage = '/final/thanks.php';
$currentpage = $_SERVER['REQUEST_URI'];

if ($currentpage == $homeurl || $currentpage == $homepage || $currentpage == $thankspage) {
  echo '<div class="hero"></div>';
}
?>
