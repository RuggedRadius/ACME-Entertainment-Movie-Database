<?php
require "./php/connection.php";

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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Searches</title>

    <?php
    require "./php/html_head.php";
    ?>
</head>
<body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript" src="./js/generateCharts.js"></script> -->
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

<div class="side-title"><p>Top 10</p></div>


<!-- Chart.js -->


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
require "./php/subscribe.php";


echo "<div id='movies-wrapper-top10'>";

// Initialise counter
$rowCounter = 1;

// Get previous
$qry = "SELECT * FROM `top10history` ORDER BY `datetime` DESC LIMIT 1, 1";
$result = mysqli_query($dbConnection, $qry);
$row = $result->fetch_assoc();

// Get all ids into array
$previousIDs = array(
    $row["id1"],
    $row["id2"],
    $row["id3"],
    $row["id4"],
    $row["id5"],
    $row["id6"],
    $row["id7"],
    $row["id8"],
    $row["id9"],
    $row["id10"]
);



// Get current
$qry = "SELECT * FROM `top10history` ORDER BY `datetime` DESC LIMIT 1";
$result = mysqli_query($dbConnection, $qry);
$row = $result->fetch_assoc();

// Get all ids into array
$currentIDs = array(
    $row["id1"],
    $row["id2"],
    $row["id3"],
    $row["id4"],
    $row["id5"],
    $row["id6"],
    $row["id7"],
    $row["id8"],
    $row["id9"],
    $row["id10"]
);

foreach ($currentIDs as $value)
{
    // Get individual movie data
    $qry = "SELECT * FROM `moviesdb` WHERE `id` = '$value'";
    $result2 = mysqli_query($dbConnection, $qry);
    $row2 = $result2->fetch_assoc();


    $previousPosition = "NEW";

    $previousCounter = 1;
    foreach ($previousIDs as $id)
    {
        if ($id === $row2["ID"])
        {
            $previousPosition = $previousCounter;
        }

        $previousCounter++;
    }

    // <h1 class='title'>" . $row2["Title"] . "</h1>

    // Output movie detials
    if (is_int($previousPosition))
    {
        $positionMovement = $previousPosition - $rowCounter;

        if ($positionMovement > 0)
        {
            echo "
            <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."'>
                <div class='movie-display-top10' id='".$row2["Title"]."'>
                <image class='movie-poster-top10' style=''>";
                        
                if ($rowCounter === 10) {
                    echo "<p class='popular-label-top10' id='".$rowCounter."' style='left: -17.5vw;'>" . $rowCounter . "</p>";
                }
                else {
                    echo "<p class='popular-label-top10' id='".$rowCounter."'>" . $rowCounter . "</p>";
                }

                echo"</image>";
            echo "<h1 class='title-movement' style='color: green;'>▲" . $positionMovement . "</h1>";
            echo "</div></a>";

        }
        else if ($positionMovement === 0)
        {
            echo "
            <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."' top10pos='1'>
                <div class='movie-display-top10' id='".$row2["Title"]."'>
                    <image class='movie-poster-top10' style=''>";
                        
                    if ($rowCounter === 10) {
                        echo "<p class='popular-label-top10' id='".$rowCounter."' style='left: -17.5vw;'>" . $rowCounter . "</p>";
                    }
                    else {
                        echo "<p class='popular-label-top10' id='".$rowCounter."'>" . $rowCounter . "</p>";
                    }

                    echo"</image>";
            // echo "<h1 class='title-movement' style='color: yellow;'>►◄</h1>";
            echo "</div></a>";
        }
        else
        {
            echo "
            <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."'>
                <div class='movie-display-top10' id='".$row2["Title"]."'>
                <image class='movie-poster-top10' style=''>";
                        
                if ($rowCounter === 10) {
                    echo "<p class='popular-label-top10' id='".$rowCounter."' style='left: -17.5vw;'>" . $rowCounter . "</p>";
                }
                else {
                    echo "<p class='popular-label-top10' id='".$rowCounter."'>" . $rowCounter . "</p>";
                }

                echo"</image>";
            echo "<h1 class='title-movement' style='color: red;'>▼" . $positionMovement * -1 . "</h1>";
            echo "</div></a>";

        }
    }
    else
    {
        echo "
        <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."'>
            <div class='movie-display-top10' id='".$row2["Title"]."'>
                <image class='movie-poster-top10'>
                    <p class='popular-label-top10'>" . $rowCounter . "</p>
                </image>
                ";
        echo "<h1 class='title-movement' style='color: purple; animation: glow 2s linear infinite;'>" . $previousPosition . "</h1>";
        echo "</div></a>";

    }


    // Increment row count
    $rowCounter++;  
}

?>













<!-- Close container div -->
<?php
    // Close container div
    echo "</div>";
?>


<script type="text/javascript" src="./js/fetchImage.js"></script>
</body>
</html>
