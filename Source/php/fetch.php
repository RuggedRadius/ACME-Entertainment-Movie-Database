<?php
/**
 * Short description for file
 *
 * PHP version 5
 *
 * @category BenFlix
 * @package  BenFlix
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */

/**
 * Outputs single detailed movie panel based on given query.
 *
 * @param string $qry the query
 *
 * @return null no return
 */
function outputMovieDetails($qry)
{
    // Connect using php script
    include "connection.php";

    // Get results
    $result = mysqli_query($dbConnection, $qry);

    // Display movie boxes
    while ($row = $result->fetch_assoc()) {

        // Update rating
        if (isset($_GET["rated"])) {
            // Get rating from post
            $rating = $_GET["rated"];

            if ($rating != null) {
                // Call method to update rating
                updateRating($row["ID"], $rating);

                // Redirect to original movie page
                header("Refresh:0; url=movie.php?id=".$row["ID"]);
            }
        }

        // Handle Add/Remove actions
        if (isset($_GET["add"])) {
            $addStatus = $_GET["add"];
            switch ($addStatus) {
                case "true":
                    addMovieToList($row["ID"]);
                    // header("Refresh:0; url=movie.php?id=".$row["ID"]);
                    echo '<script type="text/javascript">notify("Added to list", 1000, "movie.php?id='.$row['ID'].'");</script>';
                    break;

                case "false":
                    removeMovieFromList($row["ID"]);
                    // header("Refresh:0; url=movie.php?id=".$row["ID"]);
                    echo '<script type="text/javascript">notify("Removed from list", 1000, "movie.php?id='.$row['ID'].'");</script>';
                    break;

                default:
                    break;
            }
        }


        // Background YouTube Trailer
        $ytQuery = $row["Title"]." movie trailer";
        $queryFormatted = str_replace(" ", "+", $ytQuery);

        // Download html of query
        $html = file_get_contents("https://www.youtube.com/results?search_query=".$queryFormatted);
        $urlStartIndex = strpos($html, "/watch?v=");
        $ytCode = substr($html, $urlStartIndex + 9, 11);
        $videoURL = "https://www.youtube.com/embed/".$ytCode;

        // Output video trailer iframe
        echo '<div id="bg-img"><iframe src="'.$videoURL.'?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe></div>'; // https://www.youtube.com/embed/'.$ytCode.'?autoplay=1"

        // Movie detail panels
        echo '<div id="panel-wrapper">';

        // Movie Description/Overview
        echo "<div class='movie-details' id='".$row["Title"]."'>";

        // Poster Element
        // echo "<div class='movie-details-poster'>";
        echo "<image class='movie-poster-large' src='./posters/".$row["ID"].".jpg' width='20%' alt='".$row["Title"]."'></image>";
        // echo "</div>";


        // Title
        echo "<h1>".$row["Title"]."</h1>";
        // Rating
        echo "<div id='rating-stars'>";
        $starsChecked = $row["StarRating"];
        $starsUnchecked = 5 - $starsChecked;
        for ($i = 0; $i < $starsChecked; $i++) {
            echo "<a href='./movie.php?id=".$row["ID"]."&rated=".($i + 1)."'><span id='" . ($i + 1) . "' class='fa fa-star checked'></span></a>";
        }
        for ($i = 0; $i < $starsUnchecked; $i++) {
            echo "<a href='./movie.php?id=".$row["ID"]."&rated=".($starsChecked + $i + 1)."'><span id='" . ($starsChecked + $i + 1) . "' class='fa fa-star'></span>";
        }
        echo "</div>";
        // Add/Remove from list link
        $statusListed = $row["AddedList"];
        if ($statusListed > 0) {
            echo "<a href='./movie.php?id=".$row["ID"]."&add=false'><h2><i class='fa fa-thumbs-down'></i> Remove from List</h2></a>";
        } else {
            echo "<a href='./movie.php?id=".$row["ID"]."&add=true'><h2><i class='fa fa-thumbs-up'></i> Add to List</h2></a>";
        }
        echo '<br>';



        echo "<h3>Overview</h3>
                <p id='movie-overview'>".$row['overview']."</p><br>";
        

        echo "<div id='movie-data' style='display: flex; flex-wrap: wrap;'>";
        outputInfoTag("Genre", $row["Genre"]);
        outputInfoTag("Year", $row["Year"]);
        outputInfoTag("Studio", $row["Studio"]);
        outputInfoTag("Status", $row["Status"]);
        outputInfoTag("RRP", $row["RecRetPrice"]);
        outputInfoTag("Rating", $row["Rating"]);
        outputInfoTag("Popularity", $row["SearchCount"]);
        outputInfoTag("Versions", $row["Versions"]);
        outputInfoTag("Aspect", $row["Aspect"]);
        outputInfoTag("Sound", $row["Sound"]);
        echo "</div>";
        echo "</div>";

        $newSearchCount = $row["SearchCount"] + 1;
        $query = "UPDATE `moviesdb` SET `SearchCount` = '" . $newSearchCount . "' WHERE `ID` = '" . $row["ID"] . "'";
        $updateSuccess = mysqli_query($dbConnection, $query);
    }

    // Close container div
    echo "</div></div>";
}

function outputInfoTag($label, $data)
{
    echo "
    <div style='display: inline; border: 2px solid white; margin: 10px; padding: 20px;'>                
        <p style='color: white; font-size: 150%;'>
            ".$label."
        </p>
        <p style='color: gray; font-size: 120%;'>
            ".$data."
        </p>
    </div>
    ";
}

/**
 * Outputs movie data as rows in HTML table.
 *
 * @param string $qry The query.
 *
 * @return null no return
 */
function outputPopular($qry)
{
    // Connect using php script
    include "connection.php";

    // Open container div
    echo "<div id='movies-wrapper'>";

    // Get results
    $result = mysqli_query($dbConnection, $qry);

    // Filter for no results
    $rowCount = mysqli_num_rows($result);

    if ($rowCount == 0) {
        // Show error
        echo "<p style='color: red; font-size: 3rem;'>0 results found</p>";
        echo '<script type="text/javascript">notify("No results found", 3000);</script>';
    } else {
        // Display movie boxes
        while ($row = $result->fetch_assoc()) {
            // echo "<script>alert('".var_dump($row)."')</script>";
            // Output movie box display
            echo "<a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>";
            echo "<div class='movie-display' id='".$row["Title"]."'>";
            echo "<image class='movie-poster' src='./posters/".$row["ID"].".jpg' width='100px' alt='".$row["Title"]."'></image>";
            echo "<h1 class='title'>" . $row["Title"] . "</h1>";
            // echo "<p>".$row["Genre"]."</p>";
            echo "</div>";
            echo "</a>";
        }
    }

    // Close containe div
    echo "</div>";
}

/**
 * Outputs single detailed movie panel based on given query.
 *
 * @param int    $movieID The movie's ID.
 * @param string $rating  The movie's rating.
 *
 * @return null no return
 */
function updateRating($movieID, $rating)
{
    // Connect using php script
    include "connection.php";

    // Upate star rating
    $query = "UPDATE `moviesdb` SET `StarRating` = " . $rating . " WHERE ID = " . $movieID;
    $result = mysqli_query($dbConnection, $query);



    // Get global rating
    $query = "SELECT * FROM `moviesdb` WHERE `ID` = " . $movieID;
    $result = mysqli_query($dbConnection, $query);
    $row = mysqli_fetch_assoc($result);
    $globalRating = $row["globalrating"];




    // Update global rating
    $query = "UPDATE `moviesdb` SET `globalrating` = ".$globalRating." + ".$rating." WHERE ID = ".$movieID." LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
}

/**
 * Adds movie to personal list.
 *
 * @param int $movieID The movie's ID.
 *
 * @return null no return
 */
function addMovieToList($movieID)
{
    // Connect using php script
    include "connection.php";

    // Formulate query
    $query = "INSERT INTO `mylist` SELECT ID, title FROM `moviesdb` WHERE `ID`=" . $movieID;

    // Execute query
    $result = mysqli_query($dbConnection, $query);

    // Formulate query
    $query = "  UPDATE `moviesdb` 
                SET `AddedList` = 1
                WHERE ID = " . $movieID;

    // Execute query
    $result = mysqli_query($dbConnection, $query);
}

/**
 * Removes movie from personal list.
 *
 * @param int $movieID The movie's ID.
 *
 * @return null no return
 */
function removeMovieFromList($movieID)
{
    // Connect using php script
    include "connection.php";

    $query = "DELETE FROM `mylist` WHERE `ID` = " . $movieID;

    // Execute query
    $result = mysqli_query($dbConnection, $query);

    // Formulate query
    $query = "  UPDATE `moviesdb` 
        SET `AddedList` = 0
        WHERE ID = " . $movieID;

    // Execute query
    $result = mysqli_query($dbConnection, $query);
}

/**
 * Outputs a collection panel.
 *
 * @param string $collectionTitle The title of the collection.
 * @param string $keywords        The keywords for the MySQL query.
 *
 * @return null no return
 */
function outputCollectionPanel($collectionTitle, $keywords)
{
    include "connection.php";
    echo '<!-- Discover Panel -->
            <div class="discover-panel">
            <span class="genre-label-link">'.$collectionTitle.'</span>                <div class="discover-img-panel">';
    $collectionQuery = "SELECT * FROM `moviesdb` WHERE `title` LIKE '%{$keywords}%' LIMIT 12";
    $result = mysqli_query($dbConnection, $collectionQuery);
    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                <div class='discover-display' id='".$row["Title"]."'>
                    <image class='movie-poster' src='./thumbnails/".$row["ID"].".jpg' width='100px' alt='".$row["Title"]."'></image>
                </div>
            </a>";
    }
    echo '</div>
    </div>';
}

/**
 * Outputs a decade panel.
 *
 * @param string $collectionTitle The title of the collection.
 * @param string $decade          The decade for the MySQL query.
 *
 * @return null no return
 */
function outputDecadePanel($collectionTitle, $decade)
{
    include "connection.php";
    echo '<!-- Discover Panel -->
            <div class="discover-panel">
                <span class="genre-label-link">'.$collectionTitle.'</span>
                <div class="discover-img-panel">';
    $collectionQuery = "SELECT * FROM `moviesdb` WHERE `year` LIKE '".$decade."%' ORDER BY RAND() DESC LIMIT 12";
    $result = mysqli_query($dbConnection, $collectionQuery);
    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                <div class='discover-display' id='".$row["Title"]."'>
                    <image class='movie-poster' src='./thumbnails/".$row["ID"].".jpg' width='100px' alt='".$row["Title"]."'></image>
                </div>
            </a>";
    }
    echo '</div>
    </div>';
}

/**
 * Generates a discover image panel of titles for given genre.
 *
 * @param string $genre The genre of discovery panel to generate.
 *
 * @return null no return
 */
function generateImagePanel($genre)
{
    include "./php/connection.php";
    $qry = "SELECT * FROM `moviesdb` WHERE `Genre`= '" . $genre . "' ORDER BY RAND() DESC LIMIT 12";
    $result = mysqli_query($dbConnection, $qry);
    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                <div class='discover-display' id='".$row["Title"]."'>
                    <image class='movie-poster' src='./thumbnails/".$row["ID"].".jpg' width='100px' alt='".$row["Title"]."'></image>
                </div>
            </a>";
    }
}

function generateGenreContent($genre)
{
    include "./php/connection.php";

    $qry = "SELECT * FROM `moviesdb` WHERE `Genre`= '" . $genre . "'";
    $result = mysqli_query($dbConnection, $qry);

    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                    <image class='movie-poster' src='./thumbnails/".$row["ID"].".jpg' width='100px' alt='".$row["Title"]."'></image>
            </a>";
    }
}

function generateSearchResults($qry)
{
    include "./php/connection.php";

    $result = mysqli_query($dbConnection, $qry);

    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                    <image class='movie-poster' src='./thumbnails/".$row["ID"].".jpg' width='100px' alt='".$row["Title"]."'></image>
            </a>";
    }
}

/**
 * Generates a discover panel of titles for given genre.
 *
 * @param string $genre The genre of discovery panel to generate.
 *
 * @return null no return
 */
function generatePanel($genre)
{
    // Open discover panel
    echo '
    <!-- Discover Panel -->
    <div class="discover-panel">
        <a href="./genre.php?genre='.$genre.'" class="genre-label-link">
        '.$genre.'
        </a>
        <div class="discover-img-panel">
    ';

    // Populate content
    GenerateImagePanel($genre);

    // Close discover panel
    echo '
        </div>
    </div>
    ';
}
