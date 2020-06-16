<?php

require "./php/connection.php";



// addCurrentDataToTable();











// Get current top 10
$query = "SELECT * FROM `top10history` ORDER BY `datetime` DESC LIMIT 1";
$result = mysqli_query($dbConnection, $query);
$row = mysqli_fetch_assoc($result);
$currentTableValues = array($row["id1"], $row["id2"], $row["id3"], $row["id4"], $row["id5"], $row["id6"], $row["id7"], $row["id8"], $row["id9"], $row["id10"]);

// Get actual top 10 by ratings
$query = "SELECT * FROM `moviesdb` ORDER BY `globalrating` DESC LIMIT 10";
$result = mysqli_query($dbConnection, $query);
$currentRealValues = array();
while ($row = $result->fetch_assoc()) 
{
    array_push($currentRealValues, $row["ID"]);
}

// Compare arrays
$arraysAreEqual = ($currentTableValues === $currentRealValues);

// if different, add new entry to top 10 history table
if (!$arraysAreEqual)
{
    $query = "  INSERT INTO 
                    `top10history` (`datetime`, `id1`, `id2`, `id3`, `id4`, `id5`, `id6`, `id7`, `id8`, `id9`, `id10`)
                VALUES 
                    (NOW(), 
                    '".$currentRealValues[0]."', 
                    '".$currentRealValues[1]."', 
                    '".$currentRealValues[2]."', 
                    '".$currentRealValues[3]."', 
                    '".$currentRealValues[4]."', 
                    '".$currentRealValues[5]."', 
                    '".$currentRealValues[6]."', 
                    '".$currentRealValues[7]."', 
                    '".$currentRealValues[8]."', 
                    '".$currentRealValues[9]."'
                    );
                    ";

    echo  "<script type='text/javascript'>notify($query);</script>";

    $result = mysqli_query($dbConnection, $query);  
}


function addCurrentDataToTable() {
require "./php/connection.php";


// Get actual top 10 by ratings
$query = "SELECT * FROM `moviesdb` ORDER BY `globalrating` DESC LIMIT 10";
$result = mysqli_query($dbConnection, $query);
$currentRealValues = array();
while ($row = $result->fetch_assoc()) 
{
    array_push($currentRealValues, $row["ID"]);
}

// Formulate query
$query = "  INSERT INTO 
`top10history` (`datetime`, `id1`, `id2`, `id3`, `id4`, `id5`, `id6`, `id7`, `id8`, `id9`, `id10`)
VALUES 
(NOW(), 
'".$currentRealValues[0]."', 
'".$currentRealValues[1]."', 
'".$currentRealValues[2]."', 
'".$currentRealValues[3]."', 
'".$currentRealValues[4]."', 
'".$currentRealValues[5]."', 
'".$currentRealValues[6]."', 
'".$currentRealValues[7]."', 
'".$currentRealValues[8]."', 
'".$currentRealValues[9]."'
);";
echo $query;
echo  "<script type='text/javascript'>alert($query);</script>";

// Execute statement
$result = mysqli_query($dbConnection, $query);  

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

<!-- Javascript -->
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

require "./php/subscribe.php";

// Get local movie ID
$movieID = $_GET["id"];

$query = "SELECT * FROM `moviesdb` WHERE `id`="  .$movieID;

outputMovieDetails($query);
?>










<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/fetchImageSingle.js"></script>
<script type="text/javascript" src="./js/nav.js"></script>

</body>
</html>




