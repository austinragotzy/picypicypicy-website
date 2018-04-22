<?php
include 'connect.php';

if(isset($_SESSION["loggedIn"]))
{
    echo '
    <div class="rail">

    <div class="alert alert-danger">

    <strong><span class="glyphicon glyphicon-user"></span> '. $_SESSION['fName']." ".$_SESSION["lName"].'</strong><br/>
    CS3500 Student<br/>
    <span class="member-box-links"><a href="profile.php">Profile</a> | <a href="logout.php">Logout</a></span>
    <hr>
    <ul class="nav nav-stacked">
    <li class="nav-header"> <strong><span class="glyphicon glyphicon-globe"></span>  Browse Images</strong></li>
        <li><a href="picdump.php"><span class="glyphicon glyphicon-th-list"></span> Image List</a></li>
        <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
        <li><a href="upload.php"><span class="glyphicon glyphicon-upload"></span> Upload</a></li>
        <li><a href="picdump.php?fav=100"><span class="glyphicon glyphicon-star"></span> Favorites</a></li>
    </ul>
    </div>
    </div>';
}



?>
