<?php
    include_once("connection.php");

    $server = connection();

    // $id = $_GET['ID'];
    //
    // // $sql = "SELECT * FROM students_table
    // //         WHERE `student_id` = `$id`
    // //         ";
    // // $student = $server->query($sql) or die ($server->error);

    if (isset($_POST['submit'])) {
      $fname = $_POST['firstname'];
      $mname = $_POST['middlename'];
      $lname = $_POST['lastname'];
      $grade = $_POST['grade'];
      $section = $_POST['section'];
      $lrn = $_POST['lrn'];
      $cnumber = $_POST['contactnumber'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql = "INSERT INTO `students_table`(`first_name`, `middle_name`, `last_name`, `grade`, `section`, `lrn`, `gender`,
                                           `contact_number`, `username`, `password`) VALUES (`$fname`, `$mname`, `$lname`,
                                           `$grade`, `$section`, `$lrn`, `$cnumber`, `$username`, `$password`)
                                           ";

      $server->query($sql) or die ($server->error);
      echo $sql;

    }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Register</title>
   </head>
   <body>
     <h2>Create an account</h2> <br>
     <form class="" action="student_profile.php" method="post">
       <label for="">First name:</label>
       <input type="text" name="firstname" value="" id="firstname" required>
       <label for="">Middle name:</label>
       <input type="text" name="middlename" value="" id="middlename" required>
       <label for="">Last name:</label>
       <input type="text" name="lastname" value="" id="lastname" required>
       <label for="">Grade:</label>
       <input type="number" name="grade" value="10" id="grade" required>
       <label for="">Section:</label>
       <select class="" name="" id="section" required>
         <option value="">Alpha</option>
         <option value="">Bravo</option>
         <option value="">Charlie</option>
         <option value="">Delta</option>
         <option value="">Echo</option>
       </select>
       <label for="">LRN :</label>
       <input type="text" name="lrn" id="lrn" value="">
       <label for="">Gender:</label>
       <select class="" name="gender" id="gender">
         <option value="">Male</option>
         <option value="">Female</option>
         <option value="">Others</option>
       </select>
       <label for="">Contact Number:</label>
       <input type="text" name="contactnumber" value="" id="contactnumber" required>
       <label for="">Username:</label>
       <input type="text" name="" value="" id="username" required>
       <label for="">Password:</label>
       <input type="password" name="" value="" id="password" required>
       <input type="submit" name="submit" value="Submit">
     </form>
   </body>
 </html>
