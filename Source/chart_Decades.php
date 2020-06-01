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
<script type="text/javascript" src="./js/notification.js"></script>

<div class="side-title"><p>Charts</p></div>
    <?php
        require "./php/header.php";
        // require "./php/connection.php";
        require "./php/chartPopular.php";

        echo "<div id='chart-wrapper'>";
        echo "<div id='chart-list'>
        <a href='./chart_AllTime.php'><p class='chart-select'>All Time</p></a>
        <a href='./chart_Decades.php'><p class='chart-select'>Decades</p></a>
        <a href='./chart_Genres.php'><p class='chart-select'>Genres</p></a>
        </div>";

        // Echo out
        echo "<div class='pop-chart'>";
        popGenreChart("Most Popular Movies by Decades", "SELECT `Genre`, `ID`, `SearchCount`, `Title` FROM (SELECT DISTINCT * FROM `moviesdb` ORDER BY `Genre` ASC, `SearchCount` DESC ) q GROUP BY q.Genre ORDER BY `Genre` LIMIT 10");
        echo "</div>";
        
        // outputChart("Most Popular Movies of All Time", "SELECT * FROM `moviesdb` ORDER BY `SearchCount` DESC LIMIT 10");
        // popGenreChart("Most Popular Movies by Genre", "SELECT `Genre`, `ID`, `SearchCount`, `Title` FROM (SELECT DISTINCT * FROM `moviesdb` ORDER BY `Genre` ASC, `SearchCount` DESC ) q GROUP BY q.Genre ORDER BY `Genre` LIMIT 10");
        echo "</div>";
    ?>
    <script type="text/javascript" src="./js/charts.js"></script>
</body>
</html>