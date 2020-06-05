<?php
/**
 * Outputs the admin mode table
 *
 * PHP version 5
 *
 * @category BenFlix
 * @package  BenFlix
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */

// Use connection script
require "connection.php";

// Handle un-subscription
if (isset($_GET["unsubscribe"])) {
    $emailAddress = $_GET["unsubscribe"];
    $query = "DELETE FROM `subscriptions` WHERE `email`='".$emailAddress."' LIMIT 1";
    $result = mysqli_query($dbConnection, $query);
    echo '<script type="text/javascript">notify("User un-subscribed successfully", "./php/unsubscriptions.php");</script>';
}

// Create query
$query = "SELECT * FROM `subscriptions`";

// Execute query
$result = mysqli_query($dbConnection, $query);

// Open table
echo "<table id='table-admin'>
        <col width='400'>
        <col width='100'>
        <tr>
            <th>Email Address</th>
            <th>Action</th>            
        </tr>
    ";




    


// Ouput rows
while ($row = $result->fetch_assoc()) {
    echo "  <tr>
                <td>".$row["email"]."</td>
                <td><a href='./unsubscriptions.php?unsubscribe=".$row["email"]."'><i class='fa fa-edit'></i></a></td>                
            </tr>
        ";
}

// Close table
echo "</table";
