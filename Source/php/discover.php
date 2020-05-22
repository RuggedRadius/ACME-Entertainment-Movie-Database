<?php
/**
 * Discover new movie titles.
 *
 * PHP version 5
 *
 * @category BenFlix
 * @package  BenFlix
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */

require "./php/connection.php";
require "./php/fetchPopular.php";

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
                    <image class='movie-poster' src='' width='100px'></image>
                </div>
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
    echo '
            <!-- Discover Panel -->
            <div class="discover-panel">
                <span>'.$genre.'</span>
                <div class="discover-img-panel">';
    GenerateImagePanel($genre);
    echo '</div>
            </div>';
}
