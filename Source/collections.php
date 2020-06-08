<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Captis</title>
    <?php
    require "./php/html_head.php";
    ?>
</head>

<body>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<div id="page-wrapper">
<!-- HEADER -->
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
require "./php/subscribe.php";

echo '<!-- Side Title -->
<div class="side-title"><p>Collections</p></div> 
<!-- MAIN -->
<div id="discovery-wrapper">
<!-- Collections Panel -->';

outputCollectionPanel("Planet of the Apes", "of the apes");
outputCollectionPanel("Batman", "batman");
outputCollectionPanel("Christmas", "christmas");
outputCollectionPanel("Star Trek", "star trek");
outputCollectionPanel("Star Wars", "star wars");
outputCollectionPanel("Harry Potter", "Harry Potter");
// outputCollectionPanel("The Matrix", "matrix");
// outputCollectionPanel("Superman", "superman");
// outputCollectionPanel("Lord of the Rings", "lord of the rings");
outputDecadePanel("60's", "196");
outputDecadePanel("70's", "197");
outputDecadePanel("80's", "198");
outputDecadePanel("90's", "199");
outputDecadePanel("00's", "200");
outputDecadePanel("10's", "201");
?>


<!-- Close Discovery Wrapper -->
</div>
<!-- Close Page Wrapper -->
</div>
<!-- Scripts -->
<script type="text/javascript" src="./js/fetchImage.js"></script>
<script type="text/javascript" src="./js/nav.js"></script>
</body>
</html>
