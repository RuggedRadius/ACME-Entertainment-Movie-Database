<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>

    <!-- Stylesheets -->
    <link href="./styles/styles.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
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
?>

<div class="side-title"><p>Search</p></div>
<!-- Form -->
<form id="form-search" action="./searchResults.php" method="GET">

    <!-- Title -->
    <label for="title" class="form-label">Title:</label>
    <input type="text" name="title" id="title" width="200px"><br>

    <!-- Genre -->
    <label for="title" class="form-label">Genre:</label>
    <input type="text" name="genre" id="genre" width="200px"><br>
    
    <!-- Rating -->
    <label for="title" class="form-label">Rating:</label>
    <input type="text" name="rating" id="rating" width="200px"><br>
    
    <!-- Year -->
    <label for="title" class="form-label">Year:</label>
    <input type="text" name="year" id="year" width="200px"><br>

    <!-- Search Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit">Search</button>
    </div>
</form>

</body>
</html>
