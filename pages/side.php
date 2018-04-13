<?php
include 'connect.php';

?>
<div class="rail">

   <div class="alert alert-danger">
   
   <strong><span class="glyphicon glyphicon-user"></span> <?php   ?> </strong><br/>
   CS3500 Student<br/>
   <span class="member-box-links"><a href="profile.php">Profile</a> | <a href="logout.php">Logout</a></span>
  <hr>
   <ul class="nav nav-stacked">
   <li class="nav-header"> <strong><span class="glyphicon glyphicon-globe"></span>  My Images</strong></li> 
     <li><a href="#"><span class="glyphicon glyphicon-th-list"></span> Post List</a></li>
     <!-- Substitute post_single.php?id=1 for a random PostID from the database -->
     
     <!-- Substitute image.php?id=1 for a random ImageID from the database -->
     
     <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li> 
   </ul>
 </div>
</div>
