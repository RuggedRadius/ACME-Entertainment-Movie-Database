<?php
/**
 * Fetches a single movie for display.
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
function outputData($qry)
{
    // Connect using php script
    include "connection.php";

    // Get results
    $result = mysqli_query($dbConnection, $qry);

    // Display movie boxes
    while ($row = $result->fetch_assoc()) {
        // Output movie box display
        
        // Background and Filter
        echo "<div id='bg-img'>";
        echo "</div>";
        echo "<div id='bg-filter'>";
        echo "</div>";
        
        // Panel Filter
        echo "<div id='movie-details-filter'></div>";
        echo "<div class='movie-details' id='".$row["Title"]."'>";

        // Poster Element
        echo "<div id='movie-img-left'>";
        // Poster
        echo "<image class='movie-poster' src='' width='200px'></image>";







































        // YT Trailer
        // Get query for youtube
        $ytQuery = $row["Title"]." movie trailer";
        $queryFormatted = str_replace(" ", "+", $ytQuery);

        // Download html of query
        // echo "https://www.youtube.com/results?search_query=".$queryFormatted;
        $html = "";
        $html = file_get_contents("https://www.youtube.com/results?search_query=".$queryFormatted);
        $urlStartIndex = strpos($html, "/watch?v=");
        $ytCode = substr($html, $urlStartIndex + 9, 11);
        $videoURL = "https://www.youtube.com/embed/".$ytCode;

        echo '<br><iframe src="'.$videoURL.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'; // https://www.youtube.com/embed/'.$ytCode.'?autoplay=1"
        echo "</div>";

        // Details Element
        echo "<div id='movie-details-right'>";
        echo "<h1>".$row["Title"]."</h1>";

        // Update rating
        if (isset($_GET["rated"]))
        {
        $rating = $_GET["rated"];
        if ($rating != null) {
            // Call method to update rating
            updateRating($row["ID"], $rating);

            // Redirect to original movie page
            header("Refresh:0; url=movie.php?id=".$row["ID"]);
        }
    }




































































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
        
        // Details table
        echo "
                <h3>Details</h3>
                <table id='table-movie-details'>
                    <col width='200'>
                    <col width='300'>
                    <col width='200'>
                    <col width='300'>
                ";
        echo "<tr>
        <td class='td-label'>Genre</td><td>".$row["Genre"]."</td>
        <td class='td-label'>Year</td><td>".$row["Year"]."</td>
        <tr>";
        echo "<tr>
        <td class='td-label'>Studio</td><td>".$row["Studio"]."</td>
        <td class='td-label'>Status</td><td>".$row["Status"]."</td>
        
        <tr>";
        echo "<tr><td class='td-label'>RRP</td><td>$".$row["RecRetPrice"]."</td>
        <td class='td-label'>Rating</td><td>".$row["Rating"]."</td>
        <tr>";
        echo "<tr>
        <td class='td-label'>Versions</td><td>".$row["Versions"]."</td>
        <td class='td-label'>Aspect</td><td>".$row["Aspect"]."</td>
        <tr>";
        echo "<tr>
        <td class='td-label'>Popularity</td><td>".$row["SearchCount"]."</td>
        <tr>";
        echo "</table><br>";
        
        // Movie Description/Overview
        echo "<h3>Overview</h3>";
        echo "<p id='movie-overview'></p><br>";

        // Handle Add/Remove actions
        if (isset($_GET["add"]))
        {
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
        echo "</div>";

        $newSearchCount = $row["SearchCount"] + 1;
        $query = "UPDATE `moviesdb` SET `SearchCount` = '" . $newSearchCount . "' WHERE `ID` = '" . $row["ID"] . "'";
        $updateSuccess = mysqli_query($dbConnection, $query);
    }
    // Close containe div
    echo "</div>";
}

function url_get_contents($Url)
{
    if (!function_exists('curl_init')) {
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
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

    // Formulate query
    $query = "UPDATE `moviesdb` SET `StarRating` = " . $rating . " WHERE ID = " . $movieID;
    
    // Execute query
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
