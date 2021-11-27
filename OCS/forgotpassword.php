<?php 
 require 'resources/function/connection.php';
 ?>
<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="resources/css/main.css">
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
</head>
<body>

<div class="container1">
    <div class="content1">   
        <div class="imgcontainer1">
        <form method="post">
            <i class="fa fa-lock" aria-hidden="true" style="font-size:90px"></i>
        </div>
        <center><h1>Forgot Password?</h1></center>
        <center><h3>Email</h3></center>
        <br>
        <input type="text" name="Email" placeholder="Email">
        <br><br>      
        <input type="submit" value="Change Password" name="Send">
    </form>
    </div>
</div>         
</body>
</html>

<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Login process
    $Email = $_POST['Email'];
    $query = mysqli_query($conn, "SELECT * FROM student WHERE email = '$Email'");

    
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $student_id = $row['student_id'];
        $n=8;
        function getpassword($n) {
            $password = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($password) - 1);
                $randomString .= $password[$index];
            }

            return $randomString;
        }
        $password = getpassword($n);
        $message = "
        <html>
        <body>
        <p>Your new Password is ". $password . "</p>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: '. $Email . "\r\n";
        mail($Email, 'New Password', $message,$headers);
        
        $sql = "UPDATE student SET 
         password = '$password'
        WHERE student_id = $student_id";
        $query = mysqli_query($conn, $sql);
        if($query){
            header("location:login.php");
        }   
    }else{
       ?>
       <script>
        alert("There's no Match Email Address to the database");
        </script>
       <?php
    }
    $query = mysqli_query($conn, "SELECT * FROM teacher WHERE email = '$Email'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $teacher_id = $row['teacher_id'];
        $n=8;
        function getpassword($n) {
            $password = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($password) - 1);
                $randomString .= $password[$index];
            }

            return $randomString;
        }
        $password = getpassword($n);
        $message = "
        <html>
        <body>
        <p>Your new Password is ". $password . "</p>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: '. $Email . "\r\n";
        mail($Email, 'New Password', $message,$headers);
        
        $sql = "UPDATE teacher SET 
         password = '$password'
        WHERE teacher_id = $teacher_id";
        $query = mysqli_query($conn, $sql);
        if($query){
            header("location:login.php");
        }   
    }else{
       ?>
       <script>
        alert("There's no Match Email Address to the database");
        </script>
       <?php
    }   
    

}
?>