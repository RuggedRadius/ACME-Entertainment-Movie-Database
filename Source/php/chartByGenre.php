<?php
function outputHorizGenre($chartTitle, $_query)
{
    require "./php/connection.php";

    // Echo out
    echo "<div class='pop-chart'>";

    // Execute query
    $result = mysqli_query($dbConnection, $_query);

    // Get number of rows for image size
    $numRows = mysqli_num_rows($result);

    // GD
    // Output data
    $ySize = 30;
    $barWidth = 30;
    $barSpacing = 45;
    $barStartHeight = $ySize - 50;
    // $chartTitle = "Most popular movies of all time";
    $xSize = 1500;
    $ySize = 200 + ($barSpacing * $numRows);
    $image = @imagecreatetruecolor($xSize, $ySize) or die("Cannot Initialize new GD image stream");

    // Set Colours
    $backgroundColor = imagecolorallocatealpha($image, 0, 0, 0, 0);
    $textColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $barColor = imagecolorallocatealpha($image, 255, 0, 50, 0);
    $valColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $black = imagecolorallocate($image, 250, 250, 250);
    $actualBlack = imagecolorallocate($image, 0, 0, 0);
    $bg_color = imagecolorat($image, 1, 1);
    imagecolortransparent($image, $bg_color);

    // Title
    $font = "./font2.ttf";
    // imagestring($image, 5, $xSize * 0.2, 55, $black, 5, $chartTitle);
    imagestring($image, 5, $xSize/2, 20, $chartTitle, $valColor);

    
    $posterSpacing = 35;
    $posterHeight = "150";
    $posterWidth = "90";
    
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowCounter++;
        $curCount = $row["SearchCount"];

        // Bar
        // Bar Coordinates
        $x1 = 500;
        $x2 = $x1 + (10 * $row["SearchCount"]);
        $y1 = 100 + (($rowCounter - 1) * $barSpacing);
        $y2 = $y1 + $barWidth;
        // Draw bar
        $bar = imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColor);

        $barCenterX = $x1 + (($x2 - $x1) / 2);
        imagestring($image, 5, 10, $y1 + ($barWidth/3), $row["Title"], $valColor);
        imagestring($image, 5, $barCenterX, $y2 - 20, $row["SearchCount"], $black);


        // // Image
        // // Get movie image
        // $movieTitle = $row["Title"];
        // $movieTitle = str_replace(" ", "+", $movieTitle);
        // $jsonURL = "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=".$movieTitle;
        // // Get JSON
        // $json_raw = file_get_contents($jsonURL);
        // $json = json_decode($json_raw, true);
        // // Create image
        // $imgURL = "https://image.tmdb.org/t/p/w600_and_h900_bestv2".$json["results"][0]["poster_path"];
        // $source = @imagecreatefromjpeg($imgURL);
        // // Get source image size
        // list($imgWidth, $imgHeight) = getimagesize($imgURL);
        // // Get new sizes
        // $percent = 0.06;
        // $newwidth = $imgWidth * $percent;
        // $newheight = $imgHeight * $percent;
        // // Resize
        // list($imgWidth, $imgHeight) = getimagesize($imgURL);
        // $imgX = $x2 + 10;
        // $imgY = $y2 - 40;

        // imagecopyresized(
        //     $image,
        //     $source,
        //     $imgX,
        //     $imgY,
        //     0,
        //     0,
        //     $newwidth,
        //     $newheight,
        //     $imgWidth,
        //     $imgHeight
        // );
        // // Border
        // // Co-ordinates
        // $bx1 = $imgX;
        // $by1 = $imgY + $newheight;
        // $bx2 = $bx1 + $newwidth;
        // $by2 = $by1 - $newheight;
        // $borderColor = imagecolorallocate($image, 255, 255, 255);
        // $thickness = 2;
        // // Apply
        // for ($i = 0; $i < $thickness; $i++) {
        //     ImageRectangle($image, $bx1++, $by1++, $bx2++, $by2++, $borderColor);
        // }
    }

    imagepng($image, "outputimage.png");
    echo "<br/><img src='outputimage.png'>";
    imagedestroy($image);

    echo "</div>";
}
