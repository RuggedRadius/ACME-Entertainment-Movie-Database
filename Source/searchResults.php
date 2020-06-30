<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Results</title>

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
<div class="side-title"><p>Results</p></div>
<h1 style="margin-top: 100px; width: 100%; text-align: center; font-size: 5vw; color: white;">Search Results</h1>


<!-- Open container -->
<div id='genre-container'>

<?php
require "./php/header.php";
require "./php/fetch.php";

// Formulate query
$Title = $_GET["title"];
$Genre = $_GET["genre"];
$Rating = $_GET["rating"];
$Year = $_GET["year"];

$qry = "SELECT * FROM `moviesdb` WHERE `title` LIKE '%{$Title}%' AND `genre` LIKE '%{$Genre}%' AND `rating` LIKE '%{$Rating}%' AND `year` LIKE '%{$Year}%'";

// Output data into container
generateSearchResults($qry);
?>
<!-- Close container -->
</div>

<!-- <script type="text/javascript" src="./js/fetchImage.js"></script> -->
</body>
</html>
