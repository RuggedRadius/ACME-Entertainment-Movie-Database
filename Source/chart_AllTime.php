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
<body>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/notification.js"></script>
<!-- <script type="text/javascript" src="./js/charts.js"></script> -->

<!-- Content -->
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
    $qry = "SELECT * FROM `moviesdb` ORDER BY `SearchCount` DESC LIMIT 10";
    outputChart("Most Popular Movies of All Time", $qry);
    ?>
    </div>
</div>

    
</body>
</html>

