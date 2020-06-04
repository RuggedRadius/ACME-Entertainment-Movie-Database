<?php
/**
 * Outputs a static admin header for the website.
 *
 * PHP version 5
 *
 * @category BenFlix
 * @package  BenFlix
 * @author   Ben Royans <ben.royans@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */

echo "  <!-- HEADER -->
        <div id='page-header'>

            <!-- Logo -->
            <div id='logo'>
                <a href='./index.php'><p>CAPTIS</p></a>
                <h2 style='font-size: 2rem; color: gray; line-height: 0px;'>Admin Mode</h2>            
            </div>
            
            <!-- Nav Links -->
            <div id='nav-links'>
                <a href='./addMovie.php'><i class='fa fa-plus'></i>Add Movie</a>
                <a href='movie.php?id=1&download=true&auto=true'><i class='fa fa-download'></i>Update Database Information</a>
            </div>
        </div>";
