<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Movie</title>
    <?php
    require "./php/html_head.php";
    ?>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/notification.js"></script>
<!-- Navigation Header -->
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

session_start();

if (!isset($_SESSION["username"]))
{
    echo '<script type="text/javascript">notify("Not logged in", 000, "login.php");</script>';



}
else
{
    require "./php/headerAdmin.php";
    require "./php/connection.php";

    if (isset($_GET["Title"])) {
        $newTitle = $_GET["Title"];
        $newStudio = $_GET["Studio"];
        $newStatus = $_GET["Status"];
        $newSound = $_GET["Sound"];
        $newVersions = $_GET["Versions"];
        $newRRP = $_GET["RecRetPrice"];
        $newRating = $_GET["Rating"];
        $newYear = $_GET["Year"];
        $newGenre = $_GET["Genre"];
        $newAspect = $_GET["Aspect"];
        $newSearchCount = $_GET["SearchCount"];
        $newAddedList = $_GET["AddedList"];
        $newStarRating = $_GET["StarRating"];
        $query = "INSERT INTO 
            `moviesdb` (`Title`, `Studio`, `Status`, `Sound`, `Versions`, `RecRetPrice`, `Rating`, `Year`, `Genre`, `Aspect`, `SearchCount`, `AddedList`, `StarRating`)
        VALUES 
            ('".$newTitle."', '".$newStudio."', '".$newStatus."', '".$newSound."', '".$newVersions."', '".$newRRP."', '".$newRating."', '".$newYear."', '".$newGenre."', '".$newAspect."', '".$newSearchCount."', '".$newAddedList."', '".$newStarRating."')";

        echo "<script>$query</script>";
        $result = mysqli_query($dbConnection, $query);

        $query = "SELECT * FROM `moviesdb` WHERE `Title`='".$newTitle."' LIMIT 1";
        $result = mysqli_query($dbConnection, $query);
        $newMovieID = 1;
        while ($row = $result->fetch_assoc()) {
            $newMovieID = $row["ID"];
        }
        echo '<script type="text/javascript">notify("Movie added", 00, "modifymovie.php?id='.$newMovieID.'");</script>';
    }


    
}
?>

<!-- Side Title -->
<div class="side-title"><p>Add Movie</p></div> 

<!-- Form -->
<form id="form-search" style="width: 70vw;" action="./addMovie.php" method="GET"> 
    <!-- Heading -->
    <h1 style="color: white; text-align: center;">Add Movie</h1> 
    <br>

    <table id='table-movie-details'>             
    <tr>
        <!-- Title -->
        <div class="form-coupling">
        <label for="Title" class="form-label">Title:</label>
        <input type="text" name="Title" id="Title" width="200px" value="">
        </div>

        <div class="form-coupling">
        <label for="Genre" class="form-label">Genre:</label>
        <input type="text" name="Genre" id="Genre" value="">
        </div>
        
        <div class="form-coupling">
        <label for="Year" class="form-label">Year:</label>
        <input type="text" name="Year" id="Year" value="">
        </div>
        
        <div class="form-coupling">
        <label for="Studio" class="form-label">Studio:</label>
        <input type="text" name="Studio" id="Studio" value="">
        </div>
        
        <div class="form-coupling">
        <label for="Status" class="form-label">Status:</label>
        <input type="text" name="Status" id="Status" value="">
        </div>
        
        <div class="form-coupling">
        <label for="Sound" class="form-label">Sound:</label>
        <input type="text" name="Sound" id="Sound" value="5.1">
        </div>
        
        <div class="form-coupling">
        <label for="Versions" class="form-label">Versions:</label>
        <input type="text" name="Versions" id="Versions" value="English">
        </div>
        
        <div class="form-coupling">
        <label for="RecRetPrice" class="form-label">RRP:</label>
        <input type="text" name="RecRetPrice" id="RecRetPrice" value="9.99">
        </div>
        
        <div class="form-coupling">
        <label for="Rating" class="form-label">Rating:</label>
        <input type="text" name="Rating" id="Rating" value="0">
        </div>
        
        <div class="form-coupling">
        <label for="Aspect" class="form-label">Aspect:</label>
        <input type="text" name="Aspect" id="Aspect" width="200px" value="16:9">
        </div>
        
        <div class="form-coupling">
        <label for="StarRating" class="form-label">Star Rating:</label>
        <input type="text" name="StarRating" id="StarRating" width="200px" value="0">
        </div>
        
        <input type="hidden" name="SearchCount" id="SearchCount" width="200px" value="0">
        <input type="hidden" name="AddedList" id="AddedList" width="200px" value="0">

    </tr>
    </table>

    <!-- Search Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit">Add Movie</button>
    </div>
</form>
</body>
</html>