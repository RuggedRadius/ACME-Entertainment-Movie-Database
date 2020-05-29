<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Searches</title>

    <!-- Stylesheets -->
    <link href="./styles/styles.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Icons -->
    <script src="https://use.fontawesome.com/af55a51058.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/notification.js"></script>

<div class="side-title"><p>Charts</p></div>
<?php
require "./php/header.php";
?>
<div id='chart-wrapper'>
<?php
    require "./php/charts_sideLinks.php";
    ?>
    <div class='pop-chart'>
    <?php
    require "./php/chartPopular.php";
    $qry = "SELECT `Genre`, `ID`, `SearchCount`, `Title` FROM (SELECT DISTINCT * FROM `moviesdb` ORDER BY `Genre` ASC, `SearchCount` DESC ) q GROUP BY q.Genre ORDER BY `Genre` LIMIT 100";
    outputHorizGenre("Most Popular Movies by Genre", $qry);
    ?>
    </div>
</div>

    <script type="text/javascript" src="./js/charts.js"></script>
</body>
</html>