<?php

function outputChart($chartTitle, $_query)
{
    require "./php/connection.php";

    // Echo out
    echo "<div class='pop-chart'>";



    // GD
    // $chartTitle = "Most popular movies of all time";
    $xSize = 1500;
    $ySize = 650;
    $image = @imagecreatetruecolor($xSize, $ySize) or die("Cannot Initialize new GD image stream");

    // Set Colours
    $backgroundColor = imagecolorallocatealpha($image, 0, 0, 0, 0);
    $textColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $barColor = imagecolorallocatealpha($image, 255, 0, 50, 0);
    $valColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $black = imagecolorallocate($image, 250, 250, 250);
    $bg_color = imagecolorat($image, 1, 1);
    imagecolortransparent($image, $bg_color);

    // Title
    imagestring($image, 5, $xSize/2, 20, $chartTitle, $valColor);

    // Graph Title
    // imagestring($image, 300, $xSize/2 - 100, 10, $chartTitle, $textColor);

    // Formulate query
    // $qry = "SELECT * FROM `moviesdb` ORDER BY `SearchCount` DESC LIMIT 10";

    // Execute query
    $result = mysqli_query($dbConnection, $_query);

    // Output data
    $barWidth = 30;
    $barSpacing = 80;
    $barStartHeight = $ySize - 50;
    
    $posterSpacing = 35;
    $posterHeight = "150";
    $posterWidth = "90";
    
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowCounter++;
        $curCount = $row["SearchCount"];

        // Bar
        // Bar Coordinates
        $x1 = (($barWidth + $barSpacing) * $rowCounter);
        $x2 = $x1 + $barWidth;
        $y1 = $barStartHeight;
        $y2 = $y1 - (4 * $curCount);
        // Draw bar
        $bar = imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColor);
        // Popularity count on top of bar
        imagestring($image, 100, $x1 + ($barWidth/2) - 5, $y1 + 20, "#".$rowCounter, $valColor);
        imagestring($image, 100, $x1 + ($barWidth/2) - 5, $y2 - 20, $curCount, $valColor);



        // Image
        // Get movie image
        $movieTitle = $row["Title"];
        $movieTitle = str_replace(" ", "+", $movieTitle);
        $jsonURL = "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=".$movieTitle;
        // Get JSON
        $json_raw = file_get_contents($jsonURL);
        $json = json_decode($json_raw, true);
        // Create image
        $imgURL = "https://image.tmdb.org/t/p/w600_and_h900_bestv2".$json["results"][0]["poster_path"];
        $source = @imagecreatefromjpeg($imgURL);
        // Get source image size
        list($imgWidth, $imgHeight) = getimagesize($imgURL);
        // Get new sizes
        $percent = 0.15;
        $newwidth = $imgWidth * $percent;
        $newheight = $imgHeight * $percent;
        // Resize
        list($imgWidth, $imgHeight) = getimagesize($imgURL);
        imagecopyresized(
            $image,
            $source,
            $x1 - ($newwidth/2) + ($barWidth/2),
            $y2 - $newheight - $posterSpacing,
            0,
            0,
            $newwidth,
            $newheight,
            $imgWidth,
            $imgHeight
        );



        // Border
        // Co-ordinates
        $bx1 = $x1 - ($newwidth/2) + ($barWidth/2);
        $by1 = $y2 - $posterSpacing;
        $bx2 = $bx1 + $newwidth;
        $by2 = $by1 - $newheight;
        $borderColor = imagecolorallocate($image, 255, 255, 255);
        $thickness = 2;
        // Apply
        for ($i = 0; $i < $thickness; $i++) {
            ImageRectangle($image, $bx1++, $by1++, $bx2++, $by2++, $borderColor);
        }
    }

    imagepng($image, "outputimage.png");
    echo "<br/><img src='outputimage.png'>";
    imagedestroy($image);

    echo "</div>";
}

function popGenreChart($chartTitle, $_query)
{
    require "./php/connection.php";

    // Execute query
    $result = mysqli_query($dbConnection, $_query);

    $numRows = mysqli_num_rows($result);

    // Echo out
    echo "<div class='pop-chart'>";

    // GD
    $xSize = 1400;
    $ySize = 500 + (500 * ($numRows/5));
    $image = @imagecreatetruecolor($xSize, $ySize) or die("Cannot Initialize new GD image stream");

    // Set Colours
    $backgroundColor = imagecolorallocatealpha($image, 0, 0, 0, 0);
    $textColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $barColor = imagecolorallocatealpha($image, 255, 0, 50, 0);
    $valColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $black = imagecolorallocate($image, 250, 250, 250);
    $bg_color = imagecolorat($image, 1, 1);
    imagecolortransparent($image, $bg_color);

    $font = "./php/font.ttf";
    imagettftext($image, 50, 0, $xSize * 0.2, 55, $black, $font, $chartTitle);
    // imagestring($image, 300, ($xSize/2) - (strlen($chartTitle)), 10, $chartTitle, $textColor);



    // Output data
    $barWidth = 30;
    $barSpacing = 220;
    $barStartY = 325;
    $barStartX = (-$barSpacing/2);
    
    $posterSpacing = 35;
    $posterHeight = "150";
    $posterWidth = "90";
    
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        if (($rowCounter%5 == 0) && ($rowCounter != 0)) {
            $barStartY += 325;
            $barStartX = (-$barSpacing/2);
        } else {
            // $barStartY = 325;
        }

        // Spacing Coordinates
        $barStartX += $barSpacing;


        $x1 = $barStartX;
        $x2 = $x1 + $barWidth;
        $y1 = $barStartY;
        $y2 = $barStartY - $posterHeight;


        // Draw Genres
        $stringWidth = imagefontwidth(5) * strlen($row["Genre"]);
        $xText = $x1;
        $yText = $y1 - 10;
        imagestring($image, 5, $xText, $yText, $row["Genre"], $valColor);

        // Image
        // Get movie image
        $movieTitle = $row["Title"];
        $movieTitle = str_replace(" ", "+", $movieTitle);
        $jsonURL = "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=".$movieTitle;
        // Get JSON
        $json_raw = file_get_contents($jsonURL);
        $json = json_decode($json_raw, true);
        // Create image
        $imgURL = "https://image.tmdb.org/t/p/w600_and_h900_bestv2".$json["results"][0]["poster_path"];
        $source = @imagecreatefromjpeg($imgURL);
        // Get source image size
        list($imgWidth, $imgHeight) = getimagesize($imgURL);
        // Get new sizes
        $percent = 0.25;
        $newwidth = $imgWidth * $percent;
        $newheight = $imgHeight * $percent;
        // Resize
        list($imgWidth, $imgHeight) = getimagesize($imgURL);
        imagecopyresized(
            $image,
            $source,
            $x1,
            $y1 - 250,//$y2 - $newheight - $posterSpacing,
            0,
            0,
            $newwidth,
            $newheight,
            $imgWidth,
            $imgHeight
        );



        // Border
        // Co-ordinates
        $bx1 = $x1;
        $by1 = $y1 - 25;
        $bx2 = $bx1 + (600 * $percent);
        $by2 = $by1 - (900 * $percent);
        $borderColor = imagecolorallocate($image, 255, 255, 255);
        $thickness = 2;
        // Apply
        for ($i = 0; $i < $thickness; $i++) {
            ImageRectangle($image, $bx1++, $by1++, $bx2++, $by2++, $borderColor);
        }

        $rowCounter++;
    }

    imagepng($image, "outputimage.png");
    echo "<br/><img src='outputimage.png'>";
    imagedestroy($image);

    // Echo out
    echo "</div>";
}

function outputChartGenre($chartTitle, $_query)
{
    require "./php/connection.php";

    // Echo out
    echo "<div class='pop-chart'>";



    // GD
    // $chartTitle = "Most popular movies of all time";
    $xSize = 1500;
    $ySize = 700;
    $image = @imagecreatetruecolor($xSize, $ySize) or die("Cannot Initialize new GD image stream");

    // Set Colours
    $backgroundColor = imagecolorallocatealpha($image, 0, 0, 0, 0);
    $textColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $barColor = imagecolorallocatealpha($image, 255, 0, 50, 0);
    $valColor = imagecolorallocatealpha($image, 255, 255, 255, 0);
    $black = imagecolorallocate($image, 250, 250, 250);
    $bg_color = imagecolorat($image, 1, 1);
    imagecolortransparent($image, $bg_color);

    // Title
    $font = "./php/font.ttf";
    imagettftext($image, 50, 0, $xSize * 0.2, 40, $black, $font, $chartTitle);

    // Execute query
    $result = mysqli_query($dbConnection, $_query);

    // Output data
    $barWidth = 30;
    $barSpacing = 80;
    $barStartHeight = $ySize - 50;
    
    $posterSpacing = 35;
    $posterHeight = "150";
    $posterWidth = "90";
    
    $rowCounter = 0;
    while ($row = $result->fetch_assoc()) {
        $rowCounter++;
        $curCount = $row["SearchCount"];

        // Bar
        // Bar Coordinates
        $x1 = (($barWidth + $barSpacing) * $rowCounter);
        $x2 = $x1 + $barWidth;
        $y1 = $barStartHeight;
        $y2 = $y1 - (4 * $curCount);
        // Draw bar
        $bar = imagefilledrectangle($image, $x1, $y1, $x2, $y2, $barColor);
        // Popularity count on top of bar
        // imagestring($image, 100, $x1 + ($barWidth/2) - 5, $y1 + 20, "#".$rowCounter, $valColor);

        $genreStr = $row["Genre"];
        $genreWraps = explode("/", $genreStr);
        for ($i = 0; $i < sizeof($genreWraps); $i++) {
            // $genreWrapWidth = imagefontwidth(5) * strlen($genreWraps[$i]);
            $genreWrapWidth = 30;
            $xPos = $x1 - ($genreWrapWidth/2) + ($barWidth/2);
            $yPos = $y1 + 10 + (20 * $i);
            imagestring($image, 5, $xPos, $yPos, $genreWraps[$i], $valColor);
        }

        // imagestring($image, 100, $x1 + ($barWidth/2) - 5, $y1 + 20, $row["Genre"], $valColor);


        imagestring($image, 100, $x1 + ($barWidth/2) - 5, $y2 - 20, $curCount, $valColor);


        // Image
        // Get movie image
        $movieTitle = $row["Title"];
        $movieTitle = str_replace(" ", "+", $movieTitle);
        $jsonURL = "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=".$movieTitle;
        // Get JSON
        $json_raw = file_get_contents($jsonURL);
        $json = json_decode($json_raw, true);
        // Create image
        $imgURL = "https://image.tmdb.org/t/p/w600_and_h900_bestv2".$json["results"][0]["poster_path"];
        $source = @imagecreatefromjpeg($imgURL);
        // Get source image size
        list($imgWidth, $imgHeight) = getimagesize($imgURL);
        // Get new sizes
        $percent = 0.15;
        $newwidth = $imgWidth * $percent;
        $newheight = $imgHeight * $percent;
        // Resize
        list($imgWidth, $imgHeight) = getimagesize($imgURL);
        imagecopyresized(
            $image,
            $source,
            $x1 - ($newwidth/2) + ($barWidth/2),
            $y2 - $newheight - $posterSpacing,
            0,
            0,
            $newwidth,
            $newheight,
            $imgWidth,
            $imgHeight
        );



        // Border
        // Co-ordinates
        $bx1 = $x1 - ($newwidth/2) + ($barWidth/2);
        $by1 = $y2 - $posterSpacing;
        $bx2 = $bx1 + $newwidth;
        $by2 = $by1 - $newheight;
        $borderColor = imagecolorallocate($image, 255, 255, 255);
        $thickness = 2;
        // Apply
        for ($i = 0; $i < $thickness; $i++) {
            ImageRectangle($image, $bx1++, $by1++, $bx2++, $by2++, $borderColor);
        }
    }

    imagepng($image, "outputimage.png");
    echo "<br/><img src='outputimage.png'>";
    imagedestroy($image);

    echo "</div>";
}
