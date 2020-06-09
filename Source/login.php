<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>

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
require "./php/subscribe.php";
require "./php/connection.php";


if (isset($_POST["username"])) {
    // CHECK DATABASE FOR EXISTING USERNAME
    $username = $_POST["username"];

    $query = "SELECT * FROM `admin` WHERE `username`='".$username."' LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        // Username was found
        if (isset($_POST["password"])) {
            if ($_POST["password"] === $row["password"]) {
                // Password matches
                echo '<script type="text/javascript">notify("Login successful", 1000, "admin.php");</script>';
            } else {
                // Password does NOT match
                echo '<script type="text/javascript">notify("Incorrect password", 5000, null);</script>';
            }
        }
    } else {
        // Username was NOT found
        echo '<script type="text/javascript">notify("Incorrect username", 5000, null);</script>';
    }
}
?>


<div class="side-title"><p>Login</p></div>
<!-- Form -->
<form id="form-login" action="./login.php" method="POST">

    <!-- Username -->
    <div class="form-coupling">
    <label for="username" class="form-label">Username:</label>
    <input type="username" name="username" id="username"><br>
    </div>

    <!-- Password -->
    <div class="form-coupling">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password"><br>
    </div>
            
    <!-- Login Button -->
    <div class="button-holder">
        <button type="submit" form="form-login" value="Submit">Login</button>
    </div>

</form>

</body>
</html>
