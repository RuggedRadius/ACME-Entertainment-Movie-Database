<?php
function DownloadMoviePoster($title, $id)
{
    require "./php/connection.php";

    ini_set("allow_url_fopen", 1);

    // Download and save image
    $output = "posters/" . $id . ".jpg";

    // Fetch movie data
    $url = GenerateRequest(FixQuery($title));
    $json = file_get_contents($url);
    $json_data = json_decode($json, true);

    // echo "<script>alert('".$url."');</script>";

    // Save image to file
    $imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
    $poster_path = $imgURLBase . $json_data["results"][0]["poster_path"];
    file_put_contents($output, file_get_contents($poster_path));

    // Add/Update overview in database
    $overview = $json_data["results"][0]["overview"];
    $overview = str_replace("'", "", $overview);
    // echo "<script>alert('".$overview."');</script>";
    $query = "  UPDATE `moviesdb` 
            SET `overview`='".$overview."'
            WHERE `ID`='".$id."'
            LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
}

function GenerateRequest($query)
{
    return "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=" . $query;
}

function FixQuery($query)
{
    $query = str_replace(" ", "+", $query);
    return $query;
}
?>

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

require "./php/headerAdmin.php";
require "./php/connection.php";
require "./php/fetch.php";

// Get local movie ID
$movieID = $_GET["id"];
$overview = "";
// Check from download information action
if (isset($_GET["download"])) {
    
    

    // Get title of movie
    $query = "SELECT * FROM `moviesdb` WHERE `id`='".$movieID."' LIMIT 1";
        
    $result = mysqli_query($dbConnection, $query);
    $movieTitle = "";
        
    while ($row = $result->fetch_assoc()) {
        $movieTitle = $row["Title"];

        //Download image to local storage
        // sleep(5);
        // echo "<script>alert('Downloading movie poster...');</script>";
        DownloadMoviePoster($movieTitle, $movieID);
        // echo "<script>alert('".$movieTitle."');</script>";
    }

    // Get moviesdb ID from moviesdb
    $movieTitle = str_replace(" ", "+", $movieTitle);
    // $movieTitle = str_replace("'", "", $movieTitle);
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
    $curStudio = str_replace("'", "", $curStudio);
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
            echo '<script type="text/javascript">notify("Movie information updated", 2000, "modifyMovie.php?id='.($movieID + 1).'&download=true&auto=true");</script>';
        }
    } else {
        echo '<script type="text/javascript">notify("Movie information updated", 2000, "modifyMovie.php?id='.$movieID.'");</script>';
    }
}

// Check for delete action
if (isset($_GET["delete"])) {
    $query = "DELETE FROM `moviesdb` WHERE `ID`='".$movieID."' LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
    echo '<script type="text/javascript">notify("Movie deleted", 2000, "admin.php");</script>';
}


// echo "<div id='btn-edit-movie'>
//     <a href=''><p><i class='fa fa-trash'></i><p></a>
// </div>";

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
    echo '<script type="text/javascript">notify("Movie has been updated.", 1000, "modifyMovie.php?id='.$valID.'");</script>';

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
    // echo "<div id='bg-filter'>";
    // echo "</div>";


    
    // Panel Filter
    echo "<div id='modify-details-filter'>";

    // Poster Element
    echo "<div id='mod-left'>";
    echo "<image class='movie-poster' id='".$row['Title']."' src='' width='200px'></image>";
    // Movie Description/Overview
    echo "<h3>Overview</h3>";
    echo "<span id='movie-overview'>$overview</span><br>";
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
                <div class='form-coupling'>
                <label class='mod-form-label'>Title:</label>
                <input type='text' name='Title' id='Title' width='200px' value='".$row["Title"]."'>
                </div>

                <!-- Genre -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Genre:</label>
                <input type='text' name='Genre' id='Genre' width='200px' value='".$row["Genre"]."'><br>
                </div>

                <!-- Year -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Year:</label>
                <input type='text' name='Year' id='Year' width='200px' value='".$row["Year"]."'><br>
                </div>

                <!-- Studio -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Studio:</label>
                <input type='text' name='Studio' id='Studio' width='200px' value='".$row["Studio"]."'><br>
                </div>

                <!-- Status -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Status:</label>
                <input type='text' name='Status' id='Status' width='200px' value='".$row["Status"]."'><br>
                </div>

                <!-- Sound -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Sound:</label>
                <input type='text' name='Sound' id='Sound' width='200px' value='".$row["Sound"]."'><br>
                </div>

                <!-- Versions -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Versions:</label>
                <input type='text' name='Versions' id='Versions' width='200px' value='".$row["Versions"]."'><br>
                </div>

                <!-- RRP -->
                <div class='form-coupling'>
                <label class='mod-form-label'>RRP:</label>
                <input type='text' name='RRP' id='RRP' width='200px' value='".$row["RecRetPrice"]."'><br>
                </div>

                <!-- Rating -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Rating:</label>
                <input type='text' name='Rating' id='Rating' width='200px' value='".$row["Rating"]."'><br>
                </div>

                <!-- Aspect -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Aspect:</label>
                <input type='text' name='Aspect' id='Aspect' width='200px' value='".$row["Aspect"]."'><br>
                </div>

                <!-- Popularity -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Popularity:</label>
                <input type='text' name='Popularity' id='Popularity' width='200px' value='".$row["SearchCount"]."'><br>
                </div>

                <!-- AddedList -->
                <div class='form-coupling'>
                <label class='mod-form-label'>AddedList:</label>
                <input type='text' name='AddedList' id='AddedList' width='200px' value='".$row["AddedList"]."'><br>
                </div>

                <!-- StarRating -->
                <div class='form-coupling'>
                <label class='mod-form-label'>Star Rating:</label>
                <input type='text' name='StarRating' id='StarRating' width='200px' value='".$row["StarRating"]."'><br>
                </div>

                <!-- Search Button -->
                <div class='form-coupling'>
                <div class='button-holder'>
                    <button type='submit' form='form-modify' value='Submit'>Save Details</button>
                </div>
            </form>
            </div>
            ";

    echo "</div>";


    // Edit buttons
    echo "
        <div id='edit-btns'>
        <div class='btn-edit'>
        <a href='./modifyMovie.php?id=" . $row["ID"] . "&download=true' id='auto-update'><i class='fa fa-download'></i></a>
        </div>
        <div class='btn-edit'>
        <a href='./modifyMovie.php?id=" . $row["ID"] . "&download=true&auto=true'><i class='fa fa-forward'></i></a>
        </div>
        <div class='btn-edit'>
        <a href='./modifyMovie.php?id=" . $row["ID"] . "&delete=true'><i class='fa fa-trash'></i></a>
        </div>
        </div>";
}
// Close Filter
echo "</div>";
?>

<!-- Javascript -->
<script type="text/javascript" src="./js/fetchImageMod.js"></script>
</body>
</html>