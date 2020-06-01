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
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/notification.js"></script>

<!-- Content -->
<div class="side-title"><p>Charts</p></div>
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

echo '<div id="chart-wrapper">';

require "./php/charts_sideLinks.php";
require "./php/outputCharts.php";

if (isset($_GET)) {
    if (isset($_GET["byGenre"])) {
        $valGenre = $_GET["byGenre"];
        switch ($valGenre) {
        case "all":
            $chartTitle = "Most Popular Genres";
            $qry = "SELECT
                        `Genre`,
                        `SearchCount`
                    FROM
                        (
                        SELECT
                            *
                        FROM
                            `moviesdb`
                        ORDER BY
                            `SearchCount`
                        DESC
                    ) q
                    GROUP BY
                        q.Genre
                    ORDER BY
                        `SearchCount`
                    DESC";
            // popGenreChart($chartTitle, $qry);
            outputHorizGenresChart($chartTitle, $qry);
            break;

        case "top10":
            $chartTitle = "Most Popular Movies of All Time";
            $qry = "SELECT * FROM `moviesdb` ORDER BY `SearchCount` DESC LIMIT 10";
            // outputChart($chartTitle, $qry);
            outputHorizGenre($chartTitle, $qry);
            break;

        case "60s":
            $chartTitle = "Most 60s Popular Movies";
            $qry = "SELECT * FROM (SELECT * FROM `moviesdb` WHERE `Year` LIKE '196_' ORDER BY `SearchCount` DESC ) t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $qry);
            break;

        case "70s":
            $chartTitle = "Most 70s Popular Movies";
            $qry = "SELECT * FROM (SELECT * FROM `moviesdb` WHERE `Year` LIKE '197_' ORDER BY `SearchCount` DESC ) t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $qry);
            break;

        case "80s":
            $chartTitle = "Most 80s Popular Movies";
            $qry = "SELECT * FROM (SELECT * FROM `moviesdb` WHERE `Year` LIKE '198_' ORDER BY `SearchCount` DESC ) t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $qry);
            break;

        case "90s":
            $chartTitle = "Most 90s Popular Movies";
            $qry = "SELECT * FROM (SELECT * FROM `moviesdb` WHERE `Year` LIKE '199_' ORDER BY `SearchCount` DESC ) t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $qry);
            break;

        case "00s":
            $chartTitle = "Most 00s Popular Movies";
            $qry = "SELECT * FROM (SELECT * FROM `moviesdb` WHERE `Year` LIKE '200_' ORDER BY `SearchCount` DESC ) t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $qry);
            break;

        case "10s":
            $chartTitle = "Most 10s Popular Movies";
            $qry = "SELECT * FROM (SELECT * FROM `moviesdb` WHERE `Year` LIKE '201_' ORDER BY `SearchCount` DESC ) t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $qry);
            break;

        default:
            $chartTitle= "Popular ".$_GET["byGenre"]." Movies";
            $query = "SELECT `Genre`, `ID`, `SearchCount`, `Title` FROM (SELECT * FROM `moviesdb` WHERE `Genre` = '".$_GET["byGenre"]."') t ORDER BY `SearchCount` DESC LIMIT 10";
            outputHorizGenre($chartTitle, $query);
            break;
        }
    } else {
        echo '<div class="pop-chart">
        <p style="color: white; font-size: 3rem; text-align: center;">Select a chart on the left</p>
        </div>';
    }
}
echo '</div>';
?>
</body>
</html>

