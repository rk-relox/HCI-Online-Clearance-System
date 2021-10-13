<?php
    include_once("connection.php");

    connection();
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Login</title>
     <link rel="stylesheet" href="./Css/login.css">
   </head>
   <body>
     <form class="" action="index.html" method="post">
       <label for="">Username:</label>
       <input type="text" name="username" value="" required>
       <label for="">Password:</label>
       <input type="password" name="password" value="" required>
       <a href="#">Login</a>
       <a href="create_an_account.php">Create an account</a>
     </form>
   </body>
 </html>
