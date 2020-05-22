<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>

    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="./styles/styles.css" rel="stylesheet">
</head>

<body>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <?php
    /**
     * Add movie to personal list.
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
        require "./php/fetchMovie.php";

        $movieID = $_GET["id"];
        $query = "SELECT * FROM `moviesdb` WHERE `id`=".$movieID;

        outputData($query);
        addMovieToList($movieID);
    ?>

    <!-- Javascript -->
    <script type="text/javascript" src="./js/fetchImageSingle.js"></script>
</body>

</html>