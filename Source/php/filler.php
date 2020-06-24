<?php
ini_set('max_execution_time', 999);
set_time_limit(0);
require "./connection.php";

    // Get title of movie
    $query = "
    SELECT * 
    FROM `moviesdb` 
    WHERE overview = '';
    ";
    $result = mysqli_query($dbConnection, $query);
    $fixMovies = [];
    
    while ($row = $result->fetch_assoc()) {
        array_push($fixMovies, $row["ID"]);
    }

    echo "<script>alert('".sizeof($fixMovies)." movies');</script>";

    foreach ($fixMovies as $movieID) {
        // Get data
        $query = "
        SELECT * 
        FROM `moviesdb` 
        WHERE ID = '$movieID';
        ";
        $result = mysqli_query($dbConnection, $query);
        $row = $result->fetch_assoc();
        $title = $row["Title"];
        $url = GenerateRequest(FixQuery($title));

        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        // Use data, make changes
        $overview = $json_data["results"][0]["overview"];
        $overview = str_replace("'", "", $overview);

        // Apply changes
        $query = "  UPDATE `moviesdb` 
        SET `overview`='".$overview."'
        WHERE `ID`='".$movieID."'
        LIMIT 1";
        $result = mysqli_query($dbConnection, $query);

        echo "UPDATED: " + $title;

        sleep(1);
    }

    function GenerateRequest($query)
    {
        return "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=" . $query;
    }

    function FixQuery($query)
    {
        $query = str_replace(" ", "+", $query);
        return $query;
    }
