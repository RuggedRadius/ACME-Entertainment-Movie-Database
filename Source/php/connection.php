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

// PHP Client Setup
// 0 = XAMPP / Default
// 1 = USBWebServer
$client = 1;

// If on TAFE network, change this to 1.
// Disables YouTube trailers on movie pages.
$atTafe = 0;


// Credentials setup
switch ($client)
{
case 1:
    // USBWebServer
    $server = "localhost";
    $username = "root";
    $password = "usbw";
    $db = "movies";
    break;

default:
    // XAMPP Setup
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "movies";
    break;
}

// Turn on debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



// Connect to Database
$dbConnection = mysqli_connect($server, $username, $password, $db);
