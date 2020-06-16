<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Top Rated</title>
    <?php
    require "./php/html_head.php";
    ?>
</head>
<body>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <div class="side-title"><p>Top Rated</p></div>
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

require "./php/header.php";
require "./php/fetch.php";
require "./php/connection.php";

$qry = "SELECT * FROM `moviesdb` WHERE `StarRating`>0 ORDER BY `StarRating` DESC LIMIT 10";

// Open container div
echo "<div id='movies-wrapper'>";

// Get results
$result = mysqli_query($dbConnection, $qry);

    // Display movie boxes
while ($row = $result->fetch_assoc()) 
{
    // Output movie box display
    echo "<a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>";
    echo "<div class='movie-display' id='".$row["Title"]."'>";
    echo "<image class='movie-poster' src='' width='100px'></image>";
    echo "<h1 class='title'>" . $row["Title"] . "</h1>";
        
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

    echo "</div>";
    echo "</a>";
}
    // Close container div
    echo "</div>";
?>

<script type="text/javascript" src="./js/fetchImage.js"></script>
</body>
</html>
