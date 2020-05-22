<?php
/**
 * Output collections of movies in display panels
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
 * A method to ouput data from a parsed mysqli query.
 *
 * @param string $qry the query
 *
 * @return null no return
 */
function outputCollectionPanel($collectionTitle, $keywords)
{
    include "connection.php";
    echo '<!-- Discover Panel -->
            <div class="discover-panel">
                <span>'.$collectionTitle.'</span>
                <div class="discover-img-panel">';
    $collectionQuery = "SELECT * FROM `moviesdb` WHERE `title` LIKE '%{$keywords}%' LIMIT 12";
    $result = mysqli_query($dbConnection, $collectionQuery);
    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                <div class='discover-display' id='".$row["Title"]."'>
                    <image class='movie-poster' src='' width='100px'></image>
                </div>
            </a>";
    }
    echo '</div>
    </div>';
}

/**
 * A method to ouput data from a parsed mysqli query.
 *
 * @param string $qry the query
 *
 * @return null no return
 */
function outputDecadePanel($collectionTitle, $decade)
{
    include "connection.php";
    echo '<!-- Discover Panel -->
            <div class="discover-panel">
                <span>'.$collectionTitle.'</span>
                <div class="discover-img-panel">';
    $collectionQuery = "SELECT * FROM `moviesdb` WHERE `year` LIKE '".$decade."%' ORDER BY RAND() DESC LIMIT 12";
    $result = mysqli_query($dbConnection, $collectionQuery);
    while ($row = $result->fetch_assoc()) {
        echo "  
            <a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>
                <div class='discover-display' id='".$row["Title"]."'>
                    <image class='movie-poster' src='' width='100px'></image>
                </div>
            </a>";
    }
    echo '</div>
    </div>';
}
