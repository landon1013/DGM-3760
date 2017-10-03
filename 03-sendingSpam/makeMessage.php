<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Spam a Message</title>
  </head>
  <body>
    <form action="sendMessage.php" method="POST" enctype="multipart/form-data" name="travelInfo">
      <fieldset>
        <legend>Spam a Message</legend>
        <label>
          <p>Subject:</p>
          <input name="subject" value="" type="text" placeholder="subject" />
        </label>
        <label>
          <p>Message:</p>
          <textarea name="message" value="" type="text" placeholder="message here"></textarea>
        </label>

        <input type="submit" value="Send" class="submitBtn" />
      </fieldset>
    </form>
  </body>
</html>
