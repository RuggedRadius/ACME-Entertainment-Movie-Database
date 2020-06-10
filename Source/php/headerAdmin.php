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




echo "  
<!-- HEADER -->
<div id='page-header'>

<!-- Menu Panel -->
<div id='navMenu'>
    <p><a href='./admin.php'><i class='fa fa-home'></i>Dashboard</a></p>
    <p><a href='./admin_movieTable.php'><i class='fa fa-table'></i>Movie Table</a></p>
    <p><a href='./unsubscriptions.php'><i class='fa fa-exclamation-triangle'></i>Unsubscription Requests</a></p>
    <p><a href='./addMovie.php'><i class='fa fa-plus'></i>Add Movie</a></p>
    <p><a href='./movie.php?id=1&download=true&auto=true'><i class='fa fa-download'></i>Auto-Scrape</a></p>   
    <p><a href='./logout.php'><i class='fa fa-sign-out'></i>Logout</a></p> 
</div>

<!-- Menu Button -->
<div id='nav-links' onclick='toggleNav();'>
    <i class='fa fa-bars'><a>MENU</a></i>
</div>

<!-- Logo -->
<div id='logo'>
    <a>CAPTIS</a>
    <h2 style='font-size: 1.75rem; color: gray; line-height: 0px; transform: translateX(-50px);'>Admin Mode</h2>            
    <a href='./logout.php' style='position: absolute; transform: translate(100px, 20px);'><h2 id='logout' style='font-size: 2rem; color: lightgray; line-height: 0px;'>Log Out</h2></a>          
</div>      

</div>
";