<?php 
require 'resources/function/connection.php';
session_start();
if (!isset($_SESSION['student_id'])) {
    header("location:LogIn.php");
}
$current_id = $_SESSION['student_id'];
session_destroy();
session_start();
$_SESSION['student_id'] = $current_id;
ob_start(); 
// Establish Database Connection
$conn = connect();

$current_id = $_SESSION['student_id'];
$profilesql = "SELECT * FROM student a 
JOIN section b ON a.section_id = b.section_id
WHERE a.student_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row = mysqli_fetch_assoc($profilequery);

$profilesql1 = "SELECT a.first_name, a.middle_name, a.last_name FROM teacher a
JOIN lesson_plan b ON a.teacher_id = b.teacher_id
JOIN student c ON b.advisory_section_id = c.section_id
JOIN section d ON c.section_id = d.section_id
WHERE c.student_id = $current_id
GROUP BY a.teacher_id";
    $profilequery1 = mysqli_query($conn, $profilesql1);
$row1 = mysqli_fetch_assoc($profilequery1);
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="resources/css/main.css">
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
</head>
<body>

<?php include "resources/plugins/studentsidenav.php" ?>

      
    <div class="main">
        <table class="table-profile">
            <tr>
                <td rowspan = "3" style="width: 200px;"><center><i class="fa fa-user" aria-hidden="true" style="font-size:90px"></i></center></td>
                <td><b>Name: </b><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']?></td>
            </tr>
            <tr>
                <td><b>Grade: </b><?php echo $row['grade']?></td>
            </tr>
            <tr>
                <td><b>Section: </b><?php echo $row['section_name']?></td>   
            </tr>
            <tr>
                <td colspan="2"><b>Adviser: </b><?php echo $row1['first_name'] . ' ' . $row1['middle_name'] . ' ' . $row1['last_name']?></td>  
            </tr>
            <tr>
                <td colspan="2"><b>LRN: </b><?php echo $row['lrn']?></td>  
            </tr>
            <tr>
                <td colspan="2"><b>Contact Number: </b><?php echo $row['contact_number']?></td>  
            </tr>
            <tr>
                <td colspan="2"><b>Birthday: </b> <?php echo $row['birthday']?></td>  
            </tr>
            <tr>
                <td colspan="2"><b>Address: </b><?php echo $row['address']?></td>  
            </tr>       
        </table>
  </div>
        

    </div>
    

</body>
</html>