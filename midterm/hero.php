<header>
  <img src="img/logo.jpg" alt="logo" />
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="add.php">Add</a></li>
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
$homeurl = '/midterm/index.php';
$homepage = '/midterm/';
$thankspage = '/midterm/thanks.php';
$currentpage = $_SERVER['REQUEST_URI'];

if ($currentpage == $homeurl || $currentpage == $homepage || $currentpage == $thankspage) {
  echo '<div class="hero"></div>';
}
?>
