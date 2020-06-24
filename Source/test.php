<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="js/Chart.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


</head>
<body>

<?php

function DownloadMoviePoster($title)
{
    $title = FixQuery($title);
    $query = GenerateRequest($title);

    // Download and save image
    $output = "posters/$title.jpg";
    file_put_contents($output, file_get_contents($query));
}




function GenerateRequest($query)
{
    return "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=" . $query;
}

function FixQuery($query)
{
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    str_replace(" ", "+", $query);
    return query;
}




?>



</body>
</html>