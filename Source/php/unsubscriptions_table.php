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

// Wrapper
echo '<div id="page-wrapper-admin">';

// Open table
echo "<table id='table-admin' >
        <thead>
        <tr>
            <th style='font-size: 2rem; width: 10%;'>Email Address</th>
            <th style='font-size: 2rem; width: 10%;'>Delete From Database</th>            
        </tr>
        </thead>
        <tbody>
    ";




    


// Ouput rows
while ($row = $result->fetch_assoc()) {
    echo "  <tr>
                <td style='font-size: 1.5rem;'>".$row["email"]."</td>
                <td style='text-align: center; font-size: 2rem;'><a href='./unsubscriptions.php?unsubscribe=".$row["email"]."'><i class='fa fa-edit'></i></a></td>                
            </tr>
        ";
}

// Close table
echo "</tbody></table>";

// Close wrapper
echo "</div>";
