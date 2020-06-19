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
$currentCounts = array();
$currentRealValues = array();
$currentTitles = array();
while ($row = $result->fetch_assoc()) {
    array_push($currentRealValues, $row["ID"]);
    array_push($currentCounts, $row["globalrating"]);
    array_push($currentTitles, $row["Title"]);
}

// Compare arrays
$arraysAreEqual = ($currentTableValues === $currentRealValues);

// if different, add new entry to top 10 history table
if (!$arraysAreEqual) {
    $query = "  INSERT INTO 
                    `top10history` (`datetime`, `id1`, `id2`, `id3`, `id4`, `id5`, `id6`, `id7`, `id8`, `id9`, `id10`, `count1`, `count2`, `count3`, `count4`, `count5`, `count6`, `count7`, `count8`, `count9`, `count10`, `title1`, `title2`, `title3`, `title4`, `title5`, `title6`, `title7`, `title8`, `title9`, `title10`)
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
                    '".$currentRealValues[9]."',
                    '".$currentCounts[0]."', 
                    '".$currentCounts[1]."', 
                    '".$currentCounts[2]."', 
                    '".$currentCounts[3]."', 
                    '".$currentCounts[4]."', 
                    '".$currentCounts[5]."', 
                    '".$currentCounts[6]."', 
                    '".$currentCounts[7]."', 
                    '".$currentCounts[8]."', 
                    '".$currentCounts[9]."',
                    '".$currentTitles[0]."', 
                    '".$currentTitles[1]."', 
                    '".$currentTitles[2]."', 
                    '".$currentTitles[3]."', 
                    '".$currentTitles[4]."', 
                    '".$currentTitles[5]."', 
                    '".$currentTitles[6]."', 
                    '".$currentTitles[7]."', 
                    '".$currentTitles[8]."', 
                    '".$currentTitles[9]."'
                    );
                    ";

    echo  "<script type='text/javascript'>notify($query);</script>";

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
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="./js/Chart.BarFunnel.js"></script>

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

foreach ($currentIDs as $value) {
    // Get individual movie data
    $qry = "SELECT * FROM `moviesdb` WHERE `id` = '$value'";
    $result2 = mysqli_query($dbConnection, $qry);
    $row2 = $result2->fetch_assoc();

    $previousPosition = "NEW";

    $previousCounter = 1;

    foreach ($previousIDs as $id) {
        if ($id === $row2["ID"]) {
            $previousPosition = $previousCounter;
        }
        $previousCounter++;
    }

    // Output movie detials
    if (is_int($previousPosition)) {
        $positionMovement = $previousPosition - $rowCounter;

        if ($positionMovement > 0) {
            echo "
            <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."'>
                <div class='movie-display-top10' id='".$row2["Title"]."'>
                <image class='movie-poster-top10' style=''>";
                        
            if ($rowCounter === 10) {
                echo "<p class='popular-label-top10' id='".$rowCounter."' style='left: -20vw;'>" . $rowCounter . "</p>";
            } else {
                echo "<p class='popular-label-top10' id='".$rowCounter."'>" . $rowCounter . "</p>";
            }

            echo"</image>";
            echo "<h1 class='title-movement' style='color: green;'>▲" . $positionMovement . "</h1>";
            echo "</div></a>";
        } elseif ($positionMovement === 0) {
            echo "
            <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."' top10pos='1'>
                <div class='movie-display-top10' id='".$row2["Title"]."'>
                    <image class='movie-poster-top10' style=''>";
                        
            if ($rowCounter === 10) {
                echo "<p class='popular-label-top10' id='".$rowCounter."' style='left: -17.5vw;'>" . $rowCounter . "</p>";
            } else {
                echo "<p class='popular-label-top10' id='".$rowCounter."'>" . $rowCounter . "</p>";
            }

            echo"</image>";
            // echo "<h1 class='title-movement' style='color: yellow;'>►◄</h1>";
            echo "</div></a>";
        } else {
            echo "
            <a href='./movie.php?id=".$row2["ID"]."' id='".$row2["ID"]."'>
                <div class='movie-display-top10' id='".$row2["Title"]."'>
                <image class='movie-poster-top10' style=''>";
                        
            if ($rowCounter === 10) {
                echo "<p class='popular-label-top10' id='".$rowCounter."' style='left: -17.5vw;'>" . $rowCounter . "</p>";
            } else {
                echo "<p class='popular-label-top10' id='".$rowCounter."'>" . $rowCounter . "</p>";
            }

            echo"</image>";
            echo "<h1 class='title-movement' style='color: red;'>▼" . $positionMovement * -1 . "</h1>";
            echo "</div></a>";
        }
    } else {
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
// Close container div
echo "</div>";
?>

<h1 style="text-align: center; color: teal; margin-top: 100px; font-size: 5rem;">Historical Charts</h1>


<?php
require "./php/connection.php";

$qry = "SELECT * FROM `top10history`";
$result = mysqli_query($dbConnection, $qry);

echo "<div class='charts-wrapper'>";
// Ouput rows
$counter = 0;
while ($row = $result->fetch_assoc()) {
    echo "<div class='chart-container'><canvas class='history-graph' id='graphCanvas$counter'></canvas></div>";
    $counter++;
}

echo "</div>";
?>

<script>
    $(document).ready(function () {            
        showGraphs();
    });



    function showGraphs()
        {
            $.post("data.php",
            function (data)
            {
                for (let index = 0; index < data.length; index++) 
                {
                    var colours = ['#ebfafa', '#c2f0f0', '#99e6e6', '#70dbdb', '#47d1d1', '#2eb8b8', '#248f8f', '#196666', '#0f3d3d', '#0a2929' ];

                    var pCount1 = [parseInt(data[index].count1)];
                    var pCount2 = [parseInt(data[index].count2)]; 
                    var pCount3 = [parseInt(data[index].count3)]; 
                    var pCount4 = [parseInt(data[index].count4)]; 
                    var pCount5 = [parseInt(data[index].count5)]; 
                    var pCount6 = [parseInt(data[index].count6)]; 
                    var pCount7 = [parseInt(data[index].count7)]; 
                    var pCount8 = [parseInt(data[index].count8)]; 
                    var pCount9 = [parseInt(data[index].count9)];
                    var pCount10 = [parseInt(data[index].count10)];

                    // Continue method
                    var chartdata = { 
                        labels: name,
                        datasets: [
                            {
                                label: data[index].title1,
                                backgroundColor: colours[0],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount1
                            },
                            {
                                label: data[index].title2,
                                backgroundColor: colours[1],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount2
                            },
                            {
                                label: data[index].title3,
                                backgroundColor: colours[2],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount3
                            },
                            {
                                label: data[index].title4,
                                backgroundColor: colours[3],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount4
                            },
                            {
                                label: data[index].title5,
                                backgroundColor: colours[4],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount5
                            },
                            {
                                label: data[index].title6,
                                backgroundColor: colours[5],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount6
                            },
                            {
                                label: data[index].title7,
                                backgroundColor: colours[6],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount7
                            },
                            {
                                label: data[index].title8,
                                backgroundColor: colours[7],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount8
                            },
                            {
                                label: data[index].title9,
                                backgroundColor: colours[8],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount9
                            },
                            {
                                label: data[index].title10,
                                backgroundColor: colours[9],
                                borderColor: '#000000',
                                hoverBackgroundColor: '#307875',
                                hoverBorderColor: '#307875',
                                data: pCount10
                            }
                        ]
                    };
                    var graphTarget = $("#graphCanvas" + index);
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                                title: {
                                    display: true,
                                    text: "Top 10 Movies @ " + data[index].datetime,
                                    fontSize: 28
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                },
                                legend: {
                                    display: true,
                                    labels: {
                                        fontColor: 'rgb(255, 255, 255)'
                                    }
                                }
                        }
                    });
                }
            });
        }
        

</script>





<script type="text/javascript" src="./js/fetchImage.js"></script>
</body>
</html>
