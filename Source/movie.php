<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>

    <!-- Stylesheets -->
    <link href="./styles/styles.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/notification.js"></script>

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

require "./php/connection.php";
require "./php/header.php";
require "./php/fetch.php";

// Get local movie ID
$movieID = $_GET["id"];

// Check for delete action
$checkDeleteStatus = $_GET["delete"];
if ($checkDeleteStatus == "true") {
    $query = "DELETE FROM `moviesdb` WHERE `ID`='".$movieID."' LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
    echo '<script type="text/javascript">notify("Movie deleted", 2000, "admin.php");</script>';
}
// Check from download information action
$checkDownload = $_GET["download"];
if ($checkDownload == "true") {
    // Get title of movie
    $query = "SELECT * FROM `moviesdb` WHERE `id`='".$movieID."' LIMIT 1";
        
    $result = mysqli_query($dbConnection, $query);
    $movieTitle = "";
        
    while ($row = $result->fetch_assoc()) {
        $movieTitle = $row["Title"];
    }

    // Get moviesdb ID from moviesdb
    $movieTitle = str_replace(" ", "+", $movieTitle);
    $request = "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=".$movieTitle;
    $strJSON = file_get_contents($request);
    $json = json_decode($strJSON, true);
            
    // Get movie info
    $moviedbID = $json["results"][0]["id"];
    $request = "https://api.themoviedb.org/3/movie/".$moviedbID."?api_key=f2e15980f239d4c99375ace9706067c5";
    $strJSON = file_get_contents($request);
    $json = json_decode($strJSON, true);

    // Extract movie info
    $curGenre = $json["genres"][0]["name"];
    $curYear = $json["release_date"];
    $curYear = substr($curYear, 0, 4);
    $curStudio = $json["production_companies"][0]["name"];
    $curStatus = $json["status"];

    // Develop query/statement for MySQL
    $query = "  UPDATE `moviesdb` 
                SET `Genre`='".$curGenre."', `Year`='".$curYear."', `Studio`='".$curStudio."', `Status`='".$curStatus."' 
                WHERE `ID`='".$movieID."'
                LIMIT 1";

    // Execute query
    $result = mysqli_query($dbConnection, $query);
    // Display notification
    if (isset($_GET["auto"])) {
        if ($_GET["auto"] == "true") {
            echo '<script type="text/javascript">notify("Movie information updated", 2000, "movie.php?id='.($movieID + 1).'&download=true&auto=true");</script>';
        }
    } else {
        echo '<script type="text/javascript">notify("Movie information updated", 2000, "movie.php?id='.$movieID.'");</script>';
    }
}

// Edit buttons
echo "
<div id='edit-btns'>
<div class='btn-edit'>
<a href='./movie.php?id=" . $movieID . "&download=true' id='auto-update'><i class='fa fa-download'></i></a>
</div>
<div class='btn-edit'>
<a href='./modifyMovie.php?id=" . $movieID . "'><i class='fa fa-edit'></i></a>
</div>
<div class='btn-edit'>
<a href='./movie.php?id=" . $movieID . "&download=true&auto=true'><i class='fa fa-forward'></i></a>
</div>
<div class='btn-edit'>
<a href='./movie.php?id=" . $movieID . "&delete=true'><i class='fa fa-trash'></i></a>
</div>
</div>";

$query = "SELECT * FROM `moviesdb` WHERE `id`="  .$movieID;
outputMovieDetails($query);
?>

<!-- Javascript -->
<script type="text/javascript" src="./js/fetchImageSingle.js"></script>
</body>
</html>