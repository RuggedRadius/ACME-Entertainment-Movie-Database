<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscribe</title>

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

require "./php/header.php";
require "./php/connection.php";
require "./php/subscribe.php";


if (isset($_POST["email"])) {
    echo '<script type="text/javascript">notify("Subscription successful", 5000, null);</script>';
    $emailAddress = $_POST["email"];

    $boolWeekly = 0;
    $boolBurst = 0;

    if (isset($_POST["weekly"])) {
        $boolWeekly = 1;
    }
    if (isset($_POST["burst"])) {
        $boolBurst = 1;
    }
    
    $query = "
            INSERT INTO `subscriptions` (email, weekly, burst)
            VALUES ('".$emailAddress."', '".$boolWeekly."', '".$boolBurst."');
            ";

    $result = mysqli_query($dbConnection, $query);

    echo '<script type="text/javascript">notify("Subscription successful", 1000, null);</script>';
}
?>


<div class="side-title"><p>Subscribe</p></div>

<!-- Form -->
<form id="form-search" action="./subscribe.php" method="POST">

    <!-- Email -->
    <div class="form-coupling">
    <label for="email" class="form-label">Email:</label>
    <input type="text" name="email" id="email">
    <br>
    </div>

    <!-- Weekly -->
    <div class="form-coupling">    
    <input type="checkbox" id="weekly" name="weekly" value="weekly">
    <label for="weekly" class="form-label">Weekly</label>
    <br>
    </div>

    <!-- Burst -->
    <div class="form-coupling">    
    <input type="checkbox" id="burst" name="burst" value="burst">
    <label for="burst" class="form-label">Burst</label>
    <br>
    </div>

    <!-- Login Button -->
    <div class="button-holder">
        <button type="submit" form="form-search" value="Submit">Subscribe</button>
    </div>

</form>

</body>
</html>
