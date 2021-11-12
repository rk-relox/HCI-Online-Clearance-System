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
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel="stylesheet" href="resources/css/main.css">
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
</head>
<body>

<?php include "resources/plugins/teachersidenav.php" ?>
      
    <div class="main">
    <table class="table-profile">
            <tr>
                <td rowspan = "3" style="width: 200px;"><center><i class="fa fa-user" aria-hidden="true" style="font-size:90px"></i></center></td>
                <td><b>Name: </b><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']?></td>
            </tr>
            <tr>
                <td><b>Advisory Class: </b><?php if($row['advisory_section_id'] != null){ echo $row['section_name']; }else { echo "None"; } ?></td>
            </tr>
            <tr>
                <td><b>Assign Section: </b><?php echo $row['section_name']?></td>
            </tr>
            <tr>
                <td colspan="2"><b>Reg Number: </b><?php echo $row['teacher_id']?></td>   
            </tr>
            <tr>
                <td colspan="2"><b>Subject: </b><?php echo $row['subject_name']?></td>  
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
    

</body>
</html>