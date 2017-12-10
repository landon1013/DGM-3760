<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
    <title>Search</title>
  </head>
  <body>
    <?php include_once('hero.php'); ?>
    <div class="container">
      <h1>Search</h1>
      <form action="search.php" method="POST" enctrype="multipart/form-data">
        <fieldset>
          <legend>Search movie titles</legend>

          <label>
            <input name="movies" value="" type="text" placeholder="Toy Story" pattern="[0-9a-zA-Z-_., ]{2,99}" required />
          </label>
          <p>seperate multiple search terms with a ,</p>
        </fieldset>
        <input type="submit" name="submit" value="Search for Movies" class="btn" />
      </form>

      <?php
      if (isset($_POST['submit'])) {
        // Load the post data into PHP variables AND make it lowercase
        $movies = strtolower($_POST['movies']);
        // Remove commas from the list of search terms
        $moviesCleanUp = str_replace(',', '', $movies);
        // Turn the list into an array
        $searchTerms = explode(' ',$moviesCleanUp);

        foreach($searchTerms as $temp) {
          if(!empty($temp)) {
            $searchArray[] = $temp;
          } // End if
        } // End foreach
        // Build a WHERE clause for the $query
        $whereList = array();
        foreach ($searchArray as $temp) {
          $whereList[] = "title LIKE '%$temp%'";
        }// End foreach
        // Build the complete WHERE with OR between each term
        $whereClause = implode(' OR ',$whereList);

        // Build the search query
        $query = "SELECT * FROM final_movie";
        if(!empty($whereClause)) {
          $query .= " WHERE $whereClause";
        } // end if

        echo "<h2>Search Results for '" . $moviesCleanUp . "'</h2>";

        require_once('variables.php');
        // Connect to the database
        $dbconnection = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die ('connection to the database failed');

        // Now try to talk to the database
        $result = mysqli_query($dbconnection, $query) or die ('query failed');

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
            echo '<div class="searchBanner">';
              echo '<h2>' . $row['title'] . '</h2>';
              echo '<img src="img/' . $row['image'] . '" alt="Movie Poster" />';
              echo '<a href="details.php?id=' . $row['id'] . '" ><div class="btn">More Info</div></a>';
            echo '</div>';

            $myresults = strtolower($row['movies']);
            foreach ($searchArray as $temp) {
              $insert = '<***>' . $temp . '</***>';
              $myresults = str_replace($temp, $insert, $myresults);
            }// End foreach

            // Put the span tags back in the results string
            $myresults = str_replace('***', 'span', $myresults);
            echo '<p class="searchResults">' . $myresults . '</p>';
          } // End while
        } else {
          echo "No movies found matching <strong>'$movies'</strong>";
        } // End if else
      } // End isset
      ?>
    </div>
  </body>
</html>
