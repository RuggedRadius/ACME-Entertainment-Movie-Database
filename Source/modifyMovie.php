<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
    <?php
    require "./php/html_head.php";
    ?>
</head>

<body>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="./js/notification.js"></script>
  <div id="notes"></div>
<?php
/**
 * Modify a movie's details page.
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

echo "<div id='btn-edit-movie'>
    <a href=''><p><i class='fa fa-trash'></i><p></a>
</div>";

            // Update Details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valID = $_POST["ID"];
    $valTitle = $_POST["Title"];
    $valGenre = $_POST["Genre"];
    $valStudio = $_POST["Studio"];
    $valStatus = $_POST["Status"];
    $valSound = $_POST["Sound"];
    $valVersions = $_POST["Versions"];
    $valRRP = $_POST["RRP"];
    $valRating = $_POST["Rating"];
    $valYear = $_POST["Year"];
    $valAspect = $_POST["Aspect"];
    $valPopularity = $_POST["Popularity"];
    $valAddedList = $_POST["AddedList"];
    $valStarRating = $_POST["StarRating"];
    
    $query = "  UPDATE 
                                `moviesdb` 
                            SET 
                                `Title` = '" . $valTitle . "',
                                `Genre` = '" . $valGenre . "',
                                `Studio` = '" . $valStudio . "',
                                `Status` = '" . $valStatus . "',
                                `Sound` = '" . $valSound . "',
                                `Versions` = '" . $valVersions . "',
                                `RecRetPrice` = '" . $valRRP . "',
                                `Rating` = '" . $valRating . "',
                                `Year` = '" . $valYear . "',
                                `Aspect` = '" . $valAspect . "',
                                `SearchCount` = '" . $valPopularity . "',
                                `AddedList` = '" . $valAddedList . "',
                                `StarRating` = '" . $valStarRating . "'
                            WHERE 
                                `ID` = '" . $valID . "'
                            LIMIT 
                                1";
        
    // Execute query
    $result = mysqli_query($dbConnection, $query);

    // Show notification
    echo '<script type="text/javascript">notify("Movie has been updated.", 1000, "movie.php?id='.$valID.'");</script>';

    // Redirect to original movie page
    // header("Refresh:0; url=movie.php?id=".$valID);
}

// Execute Single movie Query
$movieID = $_GET["id"];
$query = "SELECT * FROM `moviesdb` WHERE `id`=".$movieID;
$result = mysqli_query($dbConnection, $query);

// Display movie box
while ($row = $result->fetch_assoc()) {
    // Output movie box display
    
    // Background and Filter
    echo "<div id='bg-img'>";
    echo "</div>";
    echo "<div id='bg-filter'>";
    echo "</div>";


    
    // Panel Filter
    echo "<div id='modify-details-filter'>";

    // Poster Element
    echo "<div id='mod-left'>";
    echo "<image class='movie-poster' id='".$row['Title']."' src='' width='200px'></image>";
    // Movie Description/Overview
    echo "<h3>Overview</h3>";
    echo "<span id='movie-overview'></span><br>";
    echo "</div>";

    // Details Element
    echo "<div id='mod-details-right'>";
    echo "<h1 style='white-space: nowrap'>".$row["Title"]."</h1>";

    // Details table
    echo "</a><label class='form-label'>ID: ".$row["ID"]."</label><br>";
    echo "<div id='mod-form-wrapper'>";
    echo "<!-- Form -->
            <form id='form-modify' action='./modifyMovie.php?id=".$row["ID"]."' method='POST'>

                <input type='hidden' name='ID' id='ID' value='".$row["ID"]."'>

                <!-- Title -->
                <div class='edit-row'>
                <label class='mod-form-label'>Title:</label>
                <input type='text' name='Title' id='Title' width='200px' value='".$row["Title"]."'>
                </div>

                <!-- Genre -->
                <div class='edit-row'>
                <label class='mod-form-label'>Genre:</label>
                <input type='text' name='Genre' id='Genre' width='200px' value='".$row["Genre"]."'><br>
                </div>

                <!-- Year -->
                <div class='edit-row'>
                <label class='mod-form-label'>Year:</label>
                <input type='text' name='Year' id='Year' width='200px' value='".$row["Year"]."'><br>
                </div>

                <!-- Studio -->
                <div class='edit-row'>
                <label class='mod-form-label'>Studio:</label>
                <input type='text' name='Studio' id='Studio' width='200px' value='".$row["Studio"]."'><br>
                </div>

                <!-- Status -->
                <div class='edit-row'>
                <label class='mod-form-label'>Status:</label>
                <input type='text' name='Status' id='Status' width='200px' value='".$row["Status"]."'><br>
                </div>

                <!-- Sound -->
                <div class='edit-row'>
                <label class='mod-form-label'>Sound:</label>
                <input type='text' name='Sound' id='Sound' width='200px' value='".$row["Sound"]."'><br>
                </div>

                <!-- Versions -->
                <div class='edit-row'>
                <label class='mod-form-label'>Versions:</label>
                <input type='text' name='Versions' id='Versions' width='200px' value='".$row["Versions"]."'><br>
                </div>

                <!-- RRP -->
                <div class='edit-row'>
                <label class='mod-form-label'>RRP:</label>
                <input type='text' name='RRP' id='RRP' width='200px' value='".$row["RecRetPrice"]."'><br>
                </div>

                <!-- Rating -->
                <div class='edit-row'>
                <label class='mod-form-label'>Rating:</label>
                <input type='text' name='Rating' id='Rating' width='200px' value='".$row["Rating"]."'><br>
                </div>

                <!-- Aspect -->
                <div class='edit-row'>
                <label class='mod-form-label'>Aspect:</label>
                <input type='text' name='Aspect' id='Aspect' width='200px' value='".$row["Aspect"]."'><br>
                </div>

                <!-- Popularity -->
                <div class='edit-row'>
                <label class='mod-form-label'>Popularity:</label>
                <input type='text' name='Popularity' id='Popularity' width='200px' value='".$row["SearchCount"]."'><br>
                </div>

                <!-- AddedList -->
                <div class='edit-row'>
                <label class='mod-form-label'>AddedList:</label>
                <input type='text' name='AddedList' id='AddedList' width='200px' value='".$row["AddedList"]."'><br>
                </div>

                <!-- StarRating -->
                <div class='edit-row'>
                <label class='mod-form-label'>Star Rating:</label>
                <input type='text' name='StarRating' id='StarRating' width='200px' value='".$row["StarRating"]."'><br>
                </div>

                <!-- Search Button -->
                <div class='edit-row'>
                <div class='button-holder'>
                    <button type='submit' form='form-modify' value='Submit'>Save Details</button>
                </div>
            </form>
            </div>
            ";

    echo "</div>";
}
// Close Filter
echo "</div>";
?>

<!-- Javascript -->
<script type="text/javascript" src="./js/fetchImageMod.js"></script>
</body>
</html>