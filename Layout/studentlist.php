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
<meta name='viewport' content='width=device-width, initial-scale=1'>

<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-a11y="true"></script>
<link rel="stylesheet" href="resources/css/main.css">
</head>
<body>

<?php include "resources/plugins/teachersidenav.php" ?>
      
    <div class="main">
        <center><h1>Student List</h1></center>
        <?php
        echo "<center><h3>10 - $section </h3></center>";
        
        $maleQuery = "SELECT d.last_name, d.first_name, d.middle_name, 
        d.status, c.section_name
        FROM teacher a
        JOIN lesson_plan b ON  a.teacher_id = b.teacher_id
        JOIN section c ON b.section_id = c.section_id
        JOIN student d ON b.section_id = d.section_id
        WHERE a.teacher_id = $current_id
        AND d.gender = 'Male'
        AND d.status = 'Verified'";

        $femaleQuery = "SELECT d.last_name, d.first_name, d.middle_name,
        d.status, c.section_name 
        FROM teacher a
        JOIN lesson_plan b ON  a.teacher_id = b.teacher_id
        JOIN section c ON b.section_id = c.section_id
        JOIN student d ON b.section_id = d.section_id
        WHERE a.teacher_id = $current_id
        AND d.gender = 'Female'
        AND d.status = 'Verified'";

        $maleResult = $conn->query($maleQuery);
        $femaleResult = $conn->query($femaleQuery);

        while($row1 = $maleResult->fetch_assoc()) {
            if($row1['middle_name'] != null){
                $middle_name = $row1['middle_name'][0] . '.';
            }else{
               $middle_name = $row1['middle_name'];
                
            }

        $males[] = $row1['last_name'] . ', ' . $row1['first_name'] . ' ' . $middle_name;
        }
        while($row1 = $femaleResult->fetch_assoc()) {
            if($row1['middle_name'] != null){
                $middle_name = $row1['middle_name'][0] . '.';
            }else{
               $middle_name = $row1['middle_name'];
                
            }
        $females[] = $row1['last_name'] . ', ' . $row1['first_name'] . ' ' . $middle_name;
        }
        if ($maleResult->num_rows > 0 && $femaleResult->num_rows == 0){
            $number_of_rows = sizeof($males);
            ?><table class="table-list"><?php
            echo "  <tr>
                        <td>Male</td>
                        <td>Female</td>
                    </tr>";
            for($i=0;$i<$number_of_rows;$i++)
            {
             echo " <tr>
                        <td>".@$males[$i]."</td>
                        <td>".@$females[$i]."</td>
                    </tr>";
            }
        }
        if ($maleResult->num_rows == 0 && $femaleResult->num_rows > 0){
            $number_of_rows = sizeof($females);
            ?><table class="table-list"><?php
            echo "  <tr>
                        <td>Male</td>
                        <td>Female</td>
                    </tr>";
            for($i=0;$i<$number_of_rows;$i++)
            {
             echo " <tr>
                        <td>".@$males[$i]."</td>
                        <td>".@$females[$i]."</td>
                    </tr>";
            }
        }
        if ($maleResult->num_rows > 0 && $femaleResult->num_rows > 0){
            $number_of_rows = max(sizeof($males),sizeof($females));
            ?><table class="table-list"><?php
            echo "  <tr>
                        <td>Male</td>
                        <td>Female</td>
                    </tr>";
            for($i=0;$i<$number_of_rows;$i++)
            {
             echo " <tr>
                        <td>".@$males[$i]."</td>
                        <td>".@$females[$i]."</td>
                    </tr>";
            }
        }
        
        if($maleResult->num_rows == 0 && $femaleResult->num_rows == 0) {
            echo "0 results";
            }
       
        ?>
        </table>
    </div>
    

</body>
</html>