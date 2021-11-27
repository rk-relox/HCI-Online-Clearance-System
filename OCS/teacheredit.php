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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['Firstname'];
    $middle_name = $_POST['Middlename'];
    $last_name = $_POST['Lastname'];
    $advisory_id = $_POST['AdvisoryClass'];
    $subject_id = $_POST['Subject'];
    $email = $_POST['email'];
    $birthday = $_POST['Birthday'];
    $address = $_POST['Address'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $query = mysqli_query($conn, "SELECT * FROM teacher WHERE (email = '$email' OR username = '$username') AND teacher_id != $current_id");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);       
        if($email == $row['email'] && $username != $row['username']){          
            ?><script>
              alert("Email Already Taken");
            </script><?php
        }
        else if($username == $row['username'] && $email != $row['email'] ){          
            ?><script>
              alert("Username Already Taken");
            </script><?php
        }
        else if(($email == $row['email']) && ($username == $row['username'])){
            ?><script>
            alert("Username And Email Already Taken");
          </script><?php
        }
    }else{
    $sql = "UPDATE teacher SET
    first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name',
    email = '$email', birthday = '$birthday', address = '$address', 
    username = '$username', password = '$password'
    WHERE teacher_id = '$current_id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        $query = mysqli_query($conn, "SELECT teacher_id FROM teacher WHERE username = '$username'");
        $row = mysqli_fetch_assoc($query);
        $_SESSION['teacher_id'] = $row['teacher_id'];

        if($advisory_id != "NULL"){
            $sql1 = "UPDATE lesson_plan SET
            subject_id = '$subject_id',
            advisory_section_id = '$advisory_id', section_id = '$advisory_id'
            WHERE teacher_id = '$current_id'";
            $query1 = mysqli_query($conn, $sql1);
            if($query1){
                header("location:teacherdashboard.php");
            }
          }
          else{
            $section_id = $_POST['AssignSection'];
            $sql1 = "UPDATE lesson_plan SET
            subject_id = '$subject_id', advisory_section_id = NULL, section_id = '$section_id'
            WHERE teacher_id = '$current_id'";
            $query1 = mysqli_query($conn, $sql1);
            if($query1){
                header("location:teacherdashboard.php");
            }
          }
        header("location:teacherdashboard.php");
      }
    }
}
$sectionsql = "SELECT * FROM section";
$result1 = mysqli_query($conn, $sectionsql);
$section1sql = "SELECT * FROM section";
$result2 = mysqli_query($conn, $section1sql);
$subjectsql = "SELECT * FROM subject";
$result3 = mysqli_query($conn, $subjectsql);
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
    <h2>Edit Profile</h2>
    <div class="container2">
        <div class="content2">
        <form method="post">   
        <label>First name: </label>
            <br>
            <input type="text" name="Firstname" value="<?php echo $row['first_name']?>" placeholder="First name">
            <br><br>
            <label>Middle name: </label>
            <br>
            <input type="text" name="Middlename" value="<?php echo $row['middle_name']?>" placeholder="Middle name">
            <br><br>
            <label>Last name: </label>
            <br>
            <input type="text" name="Lastname" value="<?php echo $row['last_name']?>" placeholder="Last name">
            <br><br>
            <label>Advisory Class: </label>
            <br>
            <select onchange="check()" name="AdvisoryClass" id="Advisory Class">
                    <option value="NULL">None</option>
				<?php while($row1 = mysqli_fetch_array($result1)):;?>
            		<option value="<?php  echo $row1['section_id']; ?>" <?php if($row1['section_id'] == $row['advisory_section_id']){?> selected <?php } ?>><?php echo $row1['section_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>Section Handle: </label>
            <br>
            <select name="AssignSection" id="Assign Section">
				<?php while($row2 = mysqli_fetch_array($result2)):;?>
            		<option value="<?php echo $row2['section_id'];?>" <?php if($row2['section_id'] == $row['section_id']){?> selected <?php } ?> ><?php echo $row2['section_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>Subject: </label>
            <br>
            <select name="Subject">
				<?php while($row3 = mysqli_fetch_array($result3)):;?>
            		<option value="<?php echo $row3['subject_id']; ?>" <?php if($row3['subject_id'] == $row['subject_id']){ ?> selected <?php } ?>><?php echo $row3['subject_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>Email: </label>
            <br>
            <input type="text" name="email" value="<?php echo $row['email']?>" placeholder="Email">
            <br><br>
            <label>Birthday: </label>
            <br>
            <input type="date" id="Birthday" value="<?php echo $row['birthday']?>" name="Birthday">
            <br><br>
            <label>Address: </label>
            <br>
            <input type="text" name="Address" value="<?php echo $row['address']?>" placeholder="Address">
            <br><br>
            <label>Username: </label>
            <br>
            <input type="text" name="Username" value="<?php echo $row['username']?>" placeholder="Username">
            <br><br>
            <label>Password: </label>
            <br>
            <input type="password" name="Password" placeholder="Password">
            <br><br>
            <input type="submit" value="Submit" name="Create">
        </form>
        </div>
    </div>

<script>
    function check(){
        if(document.getElementById('Advisory Class').value =="NULL")
            document.getElementById('Assign Section').disabled=false;
        else
            document.getElementById('Assign Section').disabled=true;
}
</script>
  </div>
        

    

</body>
</html>