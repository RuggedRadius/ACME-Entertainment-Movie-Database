<?php
/**
 * Outputs a static header for the website.
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
                <a href='./admin.php'><p>BenFlix</p></a>            
            </div>

            <!-- Nav Links -->
            <div id='nav-links'>
                <a href='./index.php'><i class='fa fa-eye'></i>Genres</a>
                <a href='./collections.php'><i class='fa fa-archive'></i></i>Collections</a>
                <a href='./popular.php'><i class='fa fa-fire'></i>Popular</a>
                <a href='./topRated.php'><i class='fa fa-star'></i>Top Rated</a>
                <a href='./search.php'><i class='fa fa-search'></i>Search</a>
                <a href='./charts.php'><i class='fa fa-align-left'></i>Charts</a>
                <a href='./myList.php'><i class='fa fa-heart'></i>My List</a>
            </div>
        </div>";
