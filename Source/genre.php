<?php
// Formulate query
$Genre = $_GET["genre"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $Genre ?> Movies</title>

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
 * @category ACME Movie Database
 * @package  ACME Movie Database
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */

require "./php/header.php";
require "./php/fetch.php";
?>

<!-- Side title -->
<div class="side-title"><p><?php echo $Genre ?></p></div>

<h1 style="margin-top: 100px; width: 100%; text-align: center; font-size: 5vw; color: white;"><?php echo $Genre ?> Movies</h1>

<!-- Open container -->
<div id='genre-container'>
<?php
// Output data into container
generateGenreContent($Genre);
?>
<!-- Close container -->
</div>

</body>
</html>
