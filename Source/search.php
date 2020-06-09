<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>

    <?php
    require "./php/html_head.php";
    ?>
</head>


<body>
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
require "./php/subscribe.php";

?>

<div class="side-title"><p>Search</p></div>
<!-- Form -->
<form id="form-search" action="./searchResults.php" method="GET">

    <h1 style="color: white; text-align: center;">Search</h1> 
    <br>

    <!-- Title -->
    <div class="form-coupling">
    <label for="title" class="form-label">Title:</label>
    <input type="text" name="title" id="title" placeholder="Enter title"><br>
    </div>

    <!-- Genre -->
    <div class="form-coupling">
    <label for="title" class="form-label">Genre:</label>
    <input type="text" name="genre" id="genre"><br>
    </div>
    <!-- Rating -->
        <div class="form-coupling">
    <label for="title" class="form-label">Rating:</label>
    <input type="text" name="rating" id="rating" width="200px"><br>
        </div>
    <!-- Year -->
            <div class="form-coupling">
    <label for="title" class="form-label">Year:</label>
    <input type="text" name="year" id="year" width="200px"><br>
            </div>
            
    <!-- Search Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit">Search</button>
    </div>
</form>

</body>
</html>
