<?php
    include_once("connection.php");

    connection();
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Register</title>
   </head>
   <body>
     <h2>Create an account</h2> <br>
     <form class="" action="index.html" method="post">
       <label for="">First name:</label>
       <input type="text" name="firstname" value="">
       <label for="">Middle name:</label>
       <input type="text" name="middlename" value="">
       <label for="">Last name:</label>
       <input type="text" name="lastname" value="">
       <label for="">Grade:</label>
       <input type="number" name="grade" value="10">
       <label for="">Section:</label>
       <select class="" name="">
         <option value="">Alpha</option>
         <option value="">Bravo</option>
         <option value="">Charlie</option>
         <option value="">Delta</option>
         <option value="">Echo</option>
       </select>
       <label for="">Gender:</label>
       <select class="" name="">
         <option value="">Male</option>
         <option value="">Female</option>
         <option value="">Others</option>
       </select>
       <label for="">Contact Number:</label>
       <input type="number" name="contactnumber" value="">
       <label for="">Username:</label>
       <input type="text" name="" value="">
       <label for="">Password:</label>
       <input type="password" name="" value="">
       <a href="#" type="">Submit</a>
     </form>
   </body>
 </html>
