<?php require_once('protect.php'); ?>
<!DOCTYPE html>
<html>
  <?php require_once('header.php'); ?>
  <body>
    <?php require_once('nav.php'); ?>
    <h1>Report an Outage</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
      <fieldset>
        <legend>Your Information</legend>
        <label><p>Your Name</p><input name="name" value="" type="text" placeholder="" pattern="[a-zA-Z ]{10,99}" required /></label>
        <label><p>Customer Account Number</p><input name="number" value="" type="number" placeholder="" /></label>
      </fieldset>

      <fieldset>
        <legend>Outage Details</legend>
        <label><p>Location:</p><input name="location" value="" type="text" placeholder="location" pattern="[a-zA-Z ]{10,99}" required /></label>
        <label><p>Date:</p><input name="date" value="" type="date" placeholder="" /></label>
        <label><p>Time:</p><input name="time" value="" type="time" placeholder="" /></label>
      </fieldset>
      <input type="submit" value="Report Outage" name="submit" />
    </form>
    <p><a class="btn" href="index.php">Cancel</a></p>
  </body>
</html>
