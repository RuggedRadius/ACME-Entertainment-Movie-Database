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

require "connection.php";
echo '
<div id="chart-list">
<a href="charts.php?byGenre=top10" onclick="bePatient();"><p class="chart-select">The Top 10</p></a>

<ul style="font-size: 2rem; list-style: none;">
<a href="charts.php?byGenre=60s" onclick="bePatient();"><li>60s</li></a>
<a href="charts.php?byGenre=70s" onclick="bePatient();"><li>70s</li></a>
<a href="charts.php?byGenre=80s" onclick="bePatient();"><li>80s</li></a>
<a href="charts.php?byGenre=90s" onclick="bePatient();"><li>90s</li></a>
<a href="charts.php?byGenre=00s" onclick="bePatient();"><li>00s</li></a>
<a href="charts.php?byGenre=10s" onclick="bePatient();"><li>10s</li></a>
</ul>

<a href="charts.php?byGenre=all" onclick="bePatient();"><p class="chart-select">By Genre</p></a>

<ul style="font-size: 2rem; list-style: none;">';

$uniqueGenresQuery = "SELECT DISTINCT `Genre` FROM `moviesdb`";
$result = mysqli_query($dbConnection, $uniqueGenresQuery);

while ($row = $result->fetch_assoc()) {
    echo '<a href="charts.php?byGenre='.$row["Genre"].'" onclick="bePatient();"><li>'.$row["Genre"].'</li></a>';
}
echo '  </ul>
        </div>';
        
