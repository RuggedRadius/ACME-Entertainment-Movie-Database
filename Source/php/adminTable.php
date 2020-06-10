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
        <thead>
            <tr>
                <th class='rotate' style='width: 3%;'><div><span>ID</span></div></th>
                <th class='rotate' style='width: 20%;'><div><span>Title</span></div></th>
                <th class='rotate' style='width: 5%;'><div><span>Studio</span></div></th>

                <th class='rotate' style='width: 5%;'><div><span>Status</span></div></th>
                <th class='rotate' style='width: 5%;'><div><span>Sound</span></div></th>
                <th class='rotate' style='width: 5%;'><div><span>Versions</span></div></th>

                <th class='rotate' style='width: 5%;'><div><span>RRP</span></div></th>
                <th class='rotate' style='width: 5%;'><div><span>Rating</span></div></th>
                <th class='rotate' style='width: 5%;'><div><span>Year</span></div></th>

                <th class='rotate' style='width: 5%;'><div><span>Genre</span></div></th>
                <th class='rotate' style='width: 5%;'><div><span>Aspect</span></div></th>
                <th class='rotate' style='width: 2%;'><div><span>Popularity</span></div></th>

                <th style='width: 3%;'><i class='fa fa-heart'></i></th>
                <th class='rotate' style='width: 3%;'><div><span>Star Rating</span></div></th>
                <th class='rotate' style='width: 4%;'><div><span>Modify</span></div></th>            
            </tr>
        </thead>
        <tbody>
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
echo "      </tbody>
        </table>
    </div>";

