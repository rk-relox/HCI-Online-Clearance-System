<?php
require 'resources/function/connection.php';
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("location:login.php");
}
$current_id = $_SESSION['teacher_id'];
session_destroy();
session_start();
$_SESSION['teacher_id'] = $current_id;
ob_start(); 
// Establish Database Connection
$conn = connect();
$profilesql = "SELECT section_name FROM teacher a 
JOIN lesson_plan b ON a.teacher_id = b.teacher_id
JOIN section c ON b.section_id = c.section_id
WHERE a.teacher_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row2 = mysqli_fetch_assoc($profilequery);
$section = $row2['section_name'];

$current_id = $_SESSION['teacher_id'];
$profilesql = "SELECT * FROM teacher a
JOIN lesson_plan b ON  a.teacher_id = b.teacher_id
JOIN section c ON b.section_id = c.section_id
JOIN subject d ON b.subject_id = d.subject_id
WHERE a.teacher_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row = mysqli_fetch_assoc($profilequery);
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
<link rel="stylesheet" href="resources/css/main.css">
</head>

<body>
<form method="post">
<?php include "resources/plugins/teachersidenav.php" ?>
      
    <div class="main">
        <center><h1>Student List</h1></center>
        <?php
        echo "<center><h3>10 - $section </h3></center>";
        
        include "resources/plugins/verification-table.php"
        ?>

    </div>
    
        </form>
</body>
<script>
    function reloadPage(){
        location.reload(true);
    }
</script>
</html>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted   
    if (isset($_POST['verified'])) { 
        $student_id = $_POST['verified'];
        $sql = "UPDATE student SET 
        status = 'Verified'
        WHERE student_id = '$student_id'";
        $query = mysqli_query($conn, $sql);
      
    }
    if  (isset($_POST['denied'])) {
        $student_id = $_POST['denied'];
        $sql = "DELETE FROM student
        WHERE student_id = '$student_id'";
        $query = mysqli_query($conn, $sql);
    }
}
?>