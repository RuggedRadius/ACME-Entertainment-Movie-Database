<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Mode</title>

    <?php    
    
    require "./php/html_head.php";
    ?>

</head>
<body>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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

session_start();

if (isset($_SESSION["username"]))
{
    echo '<script type="text/javascript">notify("Welcome, '.$_SESSION["username"].'!", 3000, null);</script>';
    require "./php/headerAdmin.php";
}
else
{
    echo '<script type="text/javascript">notify("Not logged in", 000, "login.php");</script>';
}
?>

<div id="dashboard" style="display:block; width: 90vw; height: auto; margin: auto; margin-top: 150px; border: 2px solid white;">
    <h1 style="color: white; text-align: center; width: 100%; font-size: 4rem; padding-bottom:50px;"> Admin Dashboard</h1>
    <p><a href='./admin_movieTable.php'><i class='fa fa-home'></i> Movie Table</a></p>
    <p><a href='./unsubscriptions.php'><i class='fa fa-exclamation-triangle'></i> Unsubscription Requests</a></p>
    <p><a href='./addMovie.php'><i class='fa fa-plus'></i> Add Movie</a></p>
    <p><a href='./modifyMovie.php?id=1&download=true&auto=true'><i class='fa fa-download'></i> Start Auto-Scrape</a></p>   
    <p><a href='./logout.php'><i class='fa fa-sign-out'></i> Logout</a></p> 
</div>

</body>
</html>