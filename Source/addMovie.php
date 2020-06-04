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
require "./php/headerAdmin.php";
require "./php/connection.php";

if ($_GET["Title"]) {
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
    echo '<script type="text/javascript">notify("Movie added", 3000, "movie.php?id='.$newMovieID.'");</script>';
}
?>

<!-- Side Title -->
<div class="side-title"><p>Add Movie</p></div> 

<!-- Form -->
<form id="form-search" style="width: 70vw;" action="./addMovie.php" method="GET">            
    <table id='table-movie-details'>
        <col width='100'>
        <col width='400'>
        <col width='200'>
        <col width='400'>                
    <tr>
        <td class='td-label'>
            <label for="Title" class="form-label">Title:</label>
        </td>
        <td class='td-label'>
            <input type="text" name="Title" id="Title" width="200px" value="TEST">
        </td>
        <td class='td-label'>
            <label for="Genre" class="form-label">Genre:</label>
        </td>
        <td class='td-label'>
            <input type="text" name="Genre" id="Genre" value="TEST">
        </td>
    </tr>
    <tr>
        <td class='td-label'>
        <label for="Year" class="form-label">Year:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Year" id="Year" value="2020">
        </td>
        <td class='td-label'>
        <label for="Studio" class="form-label">Studio:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Studio" id="Studio" value="Out"><br>
        </td>
    </tr>
    <tr>
        <td class='td-label'>
        <label for="Status" class="form-label">Status:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Status" id="Status" value="TEST">
        </td>
        <td class='td-label'>
        <label for="Sound" class="form-label">Sound:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Sound" id="Sound" value="7.2"><br>
        </td>
    </tr>
    <tr>
        <td class='td-label'>
        <label for="Versions" class="form-label">Versions:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Versions" id="Versions" value="16:9">
        </td>
        <td class='td-label'>
        <label for="RecRetPrice" class="form-label">RRP:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="RecRetPrice" id="RecRetPrice" value="99.99"><br>
        </td>
    </tr>
    <tr>
        <td class='td-label'>
        <label for="Rating" class="form-label">Rating:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Rating" id="Rating" value="G">
        </td>
        <td class='td-label'>
        <label for="Aspect" class="form-label">Aspect:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="Aspect" id="Aspect" width="200px" value="1.85:1"><br>
        </td>
    </tr>
    <tr>
        <td class='td-label'>
        <input type="hidden" name="SearchCount" id="SearchCount" width="200px" value="0">
        </td>
        <td class='td-label'>
        <input type="hidden" name="AddedList" id="AddedList" width="200px" value="0"><br>
        </td>
        <td class='td-label'>
        <label for="StarRating" class="form-label">Star Rating:</label>
        </td>
        <td class='td-label'>
        <input type="text" name="StarRating" id="StarRating" width="200px" value="0">
        </td>
    </tr>
    </table>

    <!-- Search Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit">Add Movie</button>
    </div>
</form>
</body>
</html>