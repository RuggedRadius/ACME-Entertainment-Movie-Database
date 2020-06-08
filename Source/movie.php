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

// Get local movie ID
$movieID = $_GET["id"];

$query = "SELECT * FROM `moviesdb` WHERE `id`="  .$movieID;
outputMovieDetails($query);
?>

<!-- Javascript -->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/fetchImageSingle.js"></script>
<script type="text/javascript" src="./js/nav.js"></script>

</body>
</html>