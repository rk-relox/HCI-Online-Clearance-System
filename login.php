<?php 
 require 'resources/function/connection.php';
session_start();
if (isset($_SESSION['teachers_id'])) {
    header("location:LogIn.php");
}
session_destroy();
session_start();
ob_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="resources/css/main.css">
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
</head>
<body>

<h2>Login Page</h2>
    <div class="container1">
        <div class="content1">   
            <div class="imgcontainer1">
            <form method="post">
                <i class="far fa-user-circle" aria-hidden="true" style="font-size:90px"></i>
            </div>
            <center><label>Username</label></center>
            <br>
            <input type="text" name="Username" placeholder="Username">
            <br><br>
            <center><label>Password</label></center>
            <br>
            <input type="password" name="Password" placeholder="Password">
            <br> <br>      
            <input type="submit" value="Login" name="login">
            <br><br>
            <center><a href="">Create Account</a> </center>
            <br><br>
            <center><a href="">Forgot Password?</a></center>
        </form>
        </div>
</div>
          

</body>
</html>
<?php
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Login process
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    
    $query = mysqli_query($conn, "SELECT * FROM student
    WHERE username = '$Username' AND password = '$Password'");

    $query1 = mysqli_query($conn, "SELECT * FROM teacher
    WHERE username = '$Username' AND password = '$Password'");

    if($query){
        if(mysqli_num_rows($query) == 1) {         
            $row = mysqli_fetch_assoc($query);
            $_SESSION['student_id'] = $row['student_id'];
            header("location:studentdashboard.php");
            
        }
    }

    if($query1){  
        if(mysqli_num_rows($query1) == 1) {
            $row1 = mysqli_fetch_assoc($query1);
            $_SESSION['teacher_id'] = $row1['teacher_id'];
            header("location:teacherdashboard.php");
        }
    }
}
    
?>