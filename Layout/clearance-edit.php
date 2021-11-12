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
$profilesql = "SELECT c.section_id ,c.section_name FROM teacher a 
JOIN lesson_plan b ON a.teacher_id = b.teacher_id
JOIN section c ON b.section_id = c.section_id
WHERE a.teacher_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row2 = mysqli_fetch_assoc($profilequery);
$section = $row2['section_name'];
$section_id = $row2['section_id'];

$current_id = $_SESSION['teacher_id'];
$profilesql = "SELECT * FROM teacher a
JOIN lesson_plan b ON  a.teacher_id = b.teacher_id
JOIN section c ON b.section_id = c.section_id
JOIN subject d ON b.subject_id = d.subject_id
WHERE a.teacher_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row = mysqli_fetch_assoc($profilequery);


$student_id=$_REQUEST['student_id'];
$query1 = "SELECT * FROM student a
JOIN clearance b ON a.student_id = b.student_id
JOIN section c ON a.section_id = c.section_id
JOIN lesson_plan d ON b.lesson_plan_id = d.lesson_plan_id
WHERE a.student_id = $student_id
AND d.teacher_id = $current_id"; 
$result1 = mysqli_query($conn, $query1) or die ( mysqli_error());
$row1 = mysqli_fetch_assoc($result1);
$lesson_plan_id = $row1['lesson_plan_id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
<link rel="stylesheet" href="resources/css/style.css">
</head>

<body>

        <?php include "resources/plugins/teachersidenav.php" ?>
      
        <div class="main">
        <center><h1><?php if($row1['middle_name'] != null){ echo $row1['last_name'] . ', ' .$row1['first_name'] . ' '. $row1['middle_name'];}else{ echo $row1['last_name'] . ', ' .$row1['first_name'];} ?></h1>
        <h2>10 - <?php echo $row1['section_name']?></h2></center>
        <div class="container">
        <div class="content">
        <form method="post">   
            <label>Remarks: </label>      
            <select name="Remarks" id="Remarks">
            		<option value="Pending" <?php if($row1['remarks'] == "Pending"){?> selected <?php } ?>>Pending</option>
                    <option value="Incomplete" <?php if($row1['remarks'] == "Incomplete"){?> selected <?php } ?> >Incomplete</option>
                    <option value="Complete" <?php if($row1['remarks'] == "Complete"){?> selected <?php } ?>>Complete</option>
			  </select>
              <br><br>
              <label>Comment: </label> 
              <textarea id="Comment" name="Comment" rows="4" cols="50" class="Comment"><?php if($row1['comment'] != null){echo $row1['comment'];} ?></textarea>
              <br><br>
            <input type="submit" value="Save" name="Save">
        </form>
        
        </div>
        </div>
        </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $remarks = $_POST['Remarks'];
    $comment = $_POST['Comment'];

    $sql = "UPDATE clearance SET
    remarks = '$remarks', comment = '$comment', date_time_updated = NOW()
    WHERE student_id = '$student_id'
    AND lesson_plan_id = '$lesson_plan_id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        header("location:teacherclearance.php");
    }
}

?>
