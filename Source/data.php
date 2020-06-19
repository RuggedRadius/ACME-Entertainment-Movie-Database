<?php
header('Content-Type: application/json');

require_once('./php/connection.php');

$sqlQuery = "SELECT * FROM `top10history` ORDER BY `datetime` DESC";

$result = mysqli_query($dbConnection, $sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($dbConnection);

echo json_encode($data);
