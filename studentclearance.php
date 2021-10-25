<?php
require 'resources/function/connection.php';
session_start();
if (!isset($_SESSION['student_id'])) {
    header("location:login.php");
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
JOIN section b ON b.section_id = a.section_id
WHERE a.student_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row1 = mysqli_fetch_assoc($profilequery);
$section_id = $row1['section_id'];
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
       <center><h1>Clearance Form</h1></center>
        <p><?php
         if($row1['middle_name'] != null){
            echo $row1['last_name'] . ', ' . $row1['first_name'] . ' ' . $row1['middle_name'][0]?> <span class="text-right"> 10 - <?php echo $row1['section'] ?></span></p>
        <?php }
         else{
            echo $row1['last_name'] . ', ' . $row1['first_name']?> <span class="text-right"> 10 - <?php echo $row1['section_name'] ?></span></p>
        <?php }
         ?>
       
        <?php
        $sql = "SELECT a.first_name, a.last_name, c.subject_name, d.section_name
        FROM teacher a
        JOIN lesson_plan b ON a.teacher_id = b.teacher_id
        JOIN subject c ON b.subject_id = c.subject_id
        JOIN section d ON b.section_id = d.section_id
        JOIN student e ON d.section_id = e.section_id
        WHERE d.section_id = $section_id
        GROUP BY a.teacher_id";
        

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo 
            "
            <table class='table-clearance'>
            <tr>
            <th>Subject</th>
            <th>Teacher</th>
            <th>Remarks</th>
            <th>Comments</th>
            <th>Date and Time</th>
            <th>Edit</th>
            </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
                <?php if($row1['middle_name']==null){
                    $middle_name = "";
                }else{
                    $middle_name=$row1['middle_name'];
                }?>
                <td><?php echo $row["subject_name"]; ?></td>
                <td><?php echo $row["last_name"] . ' ' . $row['first_name'] . '  ' . $middle_name; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr><?php                
            }
            echo "</table>";
        } else {
            echo "0 results";
        }?>
    </div>
    

</body>
</html>