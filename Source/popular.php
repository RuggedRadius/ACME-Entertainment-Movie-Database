<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Searches</title>

    <!-- Stylesheets -->
    <link href="./styles/styles.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Icons -->
    <script src="https://use.fontawesome.com/af55a51058.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <div class="side-title"><p>Popular</p></div>
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

require "./php/header.php";
require "./php/connection.php";

// Formulate query
$qry = "SELECT * FROM `moviesdb` ORDER BY `SearchCount` DESC LIMIT 50";

// Execute query
$result = mysqli_query($dbConnection, $qry);

// Display movie boxes
// Open container div
echo "<div id='movies-wrapper'>";

    $rowCounter = 0;
while ($row = $result->fetch_assoc()) {
    $rowCounter++;
    // Output movie box display
    echo "<a href='./movie.php?id=".$row["ID"]."' id='".$row["ID"]."'>";
    echo "<div class='movie-display' id='".$row["Title"]."'>";
    echo "<p class='popular-label'>" . $rowCounter . "</p>";
    echo "<image class='movie-poster'></image>";
    echo "<h1 class='title'>" . $row["Title"] . "</h1>";
    echo "<p>".$row["Genre"]."</p>";
    echo "</div>";
    echo "</a>";
}
    // Close container div
    echo "</div>";
?>
<script type="text/javascript" src="./js/fetchImage.js"></script>
</body>
</html>
