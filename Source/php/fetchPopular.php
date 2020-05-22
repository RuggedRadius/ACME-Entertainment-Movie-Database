<?php
/**
 * Fetches popular movies from database based on popularity.
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
 * Outputs movie data as rows in HTML table.
 *
 * @param string $qry The query.
 *
 * @return null no return
 */
function outputData($qry)
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
            // Output movie box display
            echo "<a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>";
            echo "<div class='movie-display' id='".$row["Title"]."'>";
            echo "<image class='movie-poster' src='' width='100px'></image>";
            echo "<h1 class='title'>" . $row["Title"] . "</h1>";
            // echo "<p>".$row["Genre"]."</p>";
            echo "</div>";
            echo "</a>";
        }
    }

    // Close containe div
    echo "</div>";
}
