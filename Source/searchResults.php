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
require "./php/fetch.php";

echo '<div class="side-title"><p>Results</p></div>';
// Formulate query
$Title = $_GET["title"];
$Genre = $_GET["genre"];
$Rating = $_GET["rating"];
$Year = $_GET["year"];

$qry = "SELECT * FROM `moviesdb` WHERE `title` LIKE '%{$Title}%' AND `genre` LIKE '%{$Genre}%' AND `rating` LIKE '%{$Rating}%' AND `year` LIKE '%{$Year}%'";

// Output data
outputPopular($qry);
?>

<script type="text/javascript" src="./js/fetchImage.js"></script>
</body>
</html>
