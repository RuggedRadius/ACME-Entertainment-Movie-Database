<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
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
require "./php/connection.php";
require "./php/fetch.php";


require "./php/subscribe.php";


echo '
<!-- Side Title --> 
<div class="side-title">
    <p>Genres</p>
        </div> <!-- MAIN --> 
            <div id="discovery-wrapper">';

$genresQuery = "SELECT DISTINCT `Genre` FROM `moviesdb`";
$result = mysqli_query($dbConnection, $genresQuery);
while ($row = $result->fetch_assoc()) {
    GeneratePanel($row["Genre"]);
}
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
