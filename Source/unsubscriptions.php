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
    require "./php/headerAdmin.php";
    require "./php/unsubscriptions_table.php";
}
else
{
    echo '<script type="text/javascript">notify("Not logged in", 1000, "login.php");</script>';
}
?>

</body>
</html>