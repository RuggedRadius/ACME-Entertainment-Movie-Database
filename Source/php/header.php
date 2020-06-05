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

echo "  
<!-- HEADER -->
<div id='page-header'>
</div>

<!-- Menu Panel -->
<div id='navMenu'>
    <p><a href='./index.php'><i class='fa fa-eye'></i>Genres</a></p>
    <p><a href='./collections.php'><i class='fa fa-archive'></i></i>Collections</a></p>
    <p><a href='./popular.php'><i class='fa fa-fire'></i>Popular</a></p>
    <p><a href='./search.php'><i class='fa fa-search'></i>Search</a></p>
    <p><a href='./charts.php'><i class='fa fa-align-left'></i>Charts</a></p>
    <p><a href='./login.php'><i class='fa fa-fire'></i>Admin Login</a></p>
</div>

<!-- Menu Button -->
<div id='nav-links' onclick='toggleNav();'>
    <i class='fa fa-bars'><a>MENU</a></i>
</div>

<!-- Logo -->
<div id='logo'>
    <a href='#'>CAPTIS</a>            
</div>
";

// <p><a href='./myList.php'><i class='fa fa-heart'></i>My List</a></p>
