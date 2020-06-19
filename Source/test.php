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
require "./php/connection.php";

$qry = "SELECT * FROM `top10history`";
$result = mysqli_query($dbConnection, $qry);

// Ouput rows
$counter = 0;
while ($row = $result->fetch_assoc()) {
    echo "<div id='chart-container'><canvas class='history-graph' id='graphCanvas$counter'></canvas></div>";
    $counter++;
}
?>


<script>
    $(document).ready(function () {            
        showGraphs();
    });



    function showGraphs()
        {
            $.post("data.php",
            function (data)
            {
                for (let index = 0; index < data.length; index++) {

                    var chartdata = { 
                        labels: name,
                        datasets: [
                            {
                                label: data[index].id1,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count1
                            },
                            {
                                label: data[index].id2,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count2
                            },
                            {
                                label: data[index].id3,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count3
                            },
                            {
                                label: data[index].id4,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count4
                            },
                            {
                                label: data[index].id5,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count5
                            },
                            {
                                label: data[index].id6,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count6
                            },
                            {
                                label: data[index].id7,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count7
                            },
                            {
                                label: data[index].id8,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count8
                            },
                            {
                                label: data[index].id9,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count9
                            },
                            {
                                label: data[index].id10,
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: data[index].count10
                            }
                        ]
                    };
                    var graphTarget = $("#graphCanvas" + index);
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                                title: {
                                    display: true,
                                    text: data[index].datetime
                                }
                        }
                    });
                }
            });
        }
        

</script>

</body>
</html>