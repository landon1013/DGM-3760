<!DOCTYPE html>
<html>
  <?php include_once('header.php'); ?>
  <body>
    <?php include_once('nav.php'); ?>
    <div class="container">
      <h1>Search</h1>
      <form action="search.php" method="POST" enctrype="multipart/form-data">
        <fieldset>
          <legend>What skills are you looking for?</legend>

          <label>
            <p>Skills:</p>
            <input name="skills" value="" type="text" placeholder="skill" pattern="[a-zA-Z-_., ]{2,99}" required />
          </label>
          seperate multiple search terms with a ,
        </fieldset>
        <input type="submit" name="submit" value="Search for Skills" class="btn" />
      </form>

      <?php
      if (isset($_POST['submit'])) {
        // Load the post data into PHP variables AND make it lowercase
        $skills = strtolower($_POST[skills]);
        // Remove commas from the list of search terms
        $skillsCleanUp = str_replace(',', '', $skills);
        // Turn the list into an array
        $searchTerms = explode(' ',$skillsCleanUp);

        foreach($searchTerms as $temp) {
          if(!empty($temp)) {
            $searchArray[] = $temp;
          } // End if
        } // End foreach
        // Build a WHERE clause for the $query
        $whereList = array();
        foreach ($searchArray as $temp) {
          $whereList[] = "skills LIKE '%$temp%'";
        }// End foreach
        // Build the complete WHERE with OR between each term
        $whereClause = implode(' OR ',$whereList);

        // Build the search query
        $query = "SELECT * FROM skills09";
        if(!empty($whereClause)) {
          $query .= " WHERE $whereClause";
        } // end if

        echo "<h2>Search Results for '" . $skillsCleanUp . "'</h2>";

        require_once('variables.php');
        // Connect to the database
        $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

        // Now try to talk to the database
        $result = mysqli_query($dbconnection, $query) or die ('query failed');

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            echo '<h3>' . $row[name] . '</h3>';

            $myresults = strtolower($row[skills]);
            foreach ($searchArray as $temp) {
              $insert = '<***>' . $temp . '</***>';
              $myresults = str_replace($temp, $insert, $myresults);
            }// End foreach

            // Put the span tags back in the results string
            $myresults = str_replace('***', 'span', $myresults);
            echo '<p class="searchResults">' . $myresults . '</p>';
          } // End while
        } else {
          echo "No hobbies found matching <strong>'$skills'</strong>";
        } // End if else
      } // End isset
      ?>
    </div>
  </body>
</html>
