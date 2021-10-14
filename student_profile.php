<?php
    include_once("connection.php");

    connection();

    
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Profile</title>
   </head>
   <body>
     <div class="">
       <div class="">
         <a href="student_profile.php">Student Profile</a>
       </div>
       <div class="">
         <a href="clearance_form.php">Clearance Form</a>
       </div>
       <div class="">
         <a href="edit_profile.php">Edit Profile</a>
       </div>
       <div class="">
         <p>Name : <?php  ?></p>
         <p>Grade : <?php  ?></p>
         <p>Section : <?php  ?></p>
         <p>Gender : <?php  ?></p>
         <p>Contact Number : <?php  ?></p>
         <p>Username : <?php  ?></p>
         <p>Password : <?php  ?></p>
       </div>
     </div>
   </body>
 </html>
