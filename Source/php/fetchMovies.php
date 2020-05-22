<?php
/**
 * Fetches multiple movies details from database.
 *
 * PHP version 5
 *
 * @category BenFlix
 * @package  BenFlix
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */

/**
 * Opens HTML table.
 *
 * @return null no return
 */
function openTable()
{
    echo   "<table id='movie-table'>
            <col width='100'>
            <col width='500'>
            <col width='200'>
            <col width='150'>
            <col width='50'>
            <col width='150'>
            <col width='100'>
            <col width='100'>
            <col width='100'>
            <col width='250'>
            <col width='50'>
            <col width='150'>
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
                <th>Search Count</th>
            </tr>";
}

/**
 * Closes HTML table.
 *
 * @return null no return
 */
function closeTable()
{
    echo "</table>";
}

/**
 * Outputs movie data as rows in HTML table.
 *
 * @return null no return
 */
function outputAllData()
{
    // Connect using php script
    include "connection.php";

    // Formulate query
    $qry = "SELECT * FROM `moviesdb`";

    // Get results
    $result = mysqli_query($dbConnection, $qry);

    // Display rows
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
                </tr>
        ";
    }
}

/**
 * Outputs movie data in a formatted fashion based on given query.
 *
 * @param string $qry The query
 *
 * @return null no return
 */
function outputData($qry)
{
    // Connect using php script
    include "connection.php";

    // Get results
    $result = mysqli_query($dbConnection, $qry);

    // Display rows
    while ($row = $result->fetch_assoc()) {
        // Increment search count of row
        $row["SearchCount"] = $row["SearchCount"] + 1;

        // Output row
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
                </tr>
        ";
    }
}
