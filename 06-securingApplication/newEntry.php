<!DOCTYPE html>
<html>
  <?php include_once('header.php'); ?>
  <body>
    <div id="container">
      <?php include_once('nav.php'); ?>

      <h1>Make a Comment</h1>

      <form action="addComment.php" method="POST" enctype="multipart/form-data">
        <fieldset>
          <legend>
            What do you want to say?
          </legend>
          <label>Name:</label>
          <input type="text" name="name" placeholder="John Smith" value="" />

          <select name="topic">
            <option>
              Sports
            </option>
            <option>
              Politics
            </option>
            <option>
              Movies
            </option>
          </select>

          <label>Comment:</label>
          <textarea name="comment" value=""></textarea>

          <button type="submit" name="submit">Submit</button>
        </fieldset>
      </form>
    </div>
  </body>
</html>
