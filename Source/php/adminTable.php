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

// Create query
$query = "SELECT * FROM `moviesdb`";

// Execute query
$result = mysqli_query($dbConnection, $query);

echo '<div id="page-wrapper-admin">';

// Open table
echo "<table id='table-admin'>
        <col width='5%'>
        <col width='10%'>
        <col width='10%'>

        <col width='10%'>
        <col width='5%'>
        <col width='5%'>

        <col width='5%'>
        <col width='5%'>
        <col width='5%'>

        <col width='5%'>
        <col width='5%'>
        <col width='5%'>

        <col width='5%'>
        <col width='5%'>
        <col width='5%'>

        <col width='5%'>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Studio</th>

            <th>Status</th>
            <th>Sound</th>
            <th>Versions</th>

            <th>RRP</th>
            <th>Rating</th>
            <th>Year</th>

            <th>Genre</th>
            <th>Aspect</th>
            <th>Popularity</th>

            <th><i class='fa fa-heart'></i></th>
            <th>Star Rating</th>
            <th>Modify</th>

            
        </tr>
    ";

    // Delete Row removed for simplicity
    // <th>Delete</th>

// Ouput rows
while ($row = $result->fetch_assoc()) {
    echo "  <tr>
                <td>".$row["ID"]."</td>
                <td>".$row["Title"]."</td>
                <td>".$row["Studio"]."</td>
                <td>".$row["Status"]."</td>
                <td>".$row["Sound"]."</td>
                <td>".$row["Versions"]."</td>
                <td>".$row["RecRetPrice"]."</td>
                <td>".$row["Rating"]."</td>
                <td>".$row["Year"]."</td>
                <td>".$row["Genre"]."</td>
                <td>".$row["Aspect"]."</td>
                <td>".$row["SearchCount"]."</td>
                <td>".$row["AddedList"]."</td>
                <td>".$row["StarRating"]."</td>
                <td><a href='./modifyMovie.php?id=".$row["ID"]."'><i class='fa fa-edit'></i></a></td>
                
            </tr>
        ";

    // Delete Row removed for simplicity
        // <td><a href=''><i class='fa fa-trash'></i></a></td>
}

// Close table
echo "</table";

echo "</div>";
