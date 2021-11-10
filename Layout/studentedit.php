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
$profilesql = "SELECT * FROM student WHERE student_id = $current_id";
    $profilequery = mysqli_query($conn, $profilesql);
$row = mysqli_fetch_assoc($profilequery);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['Firstname'];
    $middle_name = $_POST['Middlename'];
    $last_name = $_POST['Lastname'];
    $section_id = $_POST['Section'];
    $lrn = $_POST['LRN'];
    $gender = $_POST['Gender'];
    $contact_number = $_POST['ContactNumber'];
    $birthday = $_POST['Birthday'];
    $address = $_POST['Address'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "UPDATE student SET
    first_name = '$first_name', middle_name = '$middle_name', last_name = '$last_name',
    section_id = '$section_id', lrn = '$lrn', gender = '$gender', contact_number = '$contact_number',
    birthday = '$birthday', address = '$address', username = '$username', password = '$password'
    WHERE student_id = '$current_id'";
    $query = mysqli_query($conn, $sql);
    if($query){
        $query = mysqli_query($conn, "SELECT student_id FROM student WHERE username = '$username'");
        $row = mysqli_fetch_assoc($query);
        $_SESSION['student_id'] = $row['student_id'];
        header("location:studentdashboard.php");
      }
}
$sectionsql = "SELECT * FROM section";
$result1 = mysqli_query($conn, $sectionsql);
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
    <h2>Edit Profile</h2>
    <div class="container2">
        <div class="content2">
        <form method="post">   
            <label>First name: </label>
            <br>
            <input type="text" name="Firstname" value="<?php echo $row['first_name']?>" placeholder="First name" >
            <br><br>
            <label>Middle name: </label>
            <br>
            <input type="text" name="Middlename" value="<?php echo $row['middle_name']?>" placeholder="Middle name">
            <br><br>
            <label>Last name: </label>
            <br>
            <input type="text" name="Lastname" value="<?php echo $row['last_name']?>" placeholder="Last name">
            <br><br>
            <label>Section: </label>
            <br>
            <select name="Section">
				<?php while($row1 = mysqli_fetch_array($result1)):;?>
            		<option value="<?php  echo $row1['section_id']; ?>" <?php if($row1['section_id'] == $row['section_id']){?> selected <?php } ?>><?php echo $row1['section_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>LRN: </label>
            <br>
            <input type="text" value="<?php echo $row['lrn']?>" name="LRN" placeholder="LRN">
            <br><br>
            <label for="Gender">Gender: </label>
            <br>
            <select name="Gender" id="Gender">
            <option value="Male" <?php if($row['gender'] == "Male"){?> selected <?php } ?>>Male</option>
            <option value="Female" <?php if($row['gender'] == "Female"){?> selected <?php } ?>>Female</option>
            </select>
            <br><br>
            <label>Contact Number: </label>
            <br>
            <input type="text" value="<?php echo $row['contact_number']?>" name="ContactNumber" placeholder="Contact Number">
            <br><br>
            <label>Birthday: </label>
            <br>
            <input type="date" value="<?php echo $row['birthday']?>" id="Birthday" name="Birthday">
            <br><br>
            <label>Address: </label>
            <br>
            <input type="text" value="<?php echo $row['address']?>" name="Address" placeholder="Address">
            <br><br>
            <label>Username: </label>
            <br>
            <input type="text" name="Username" value="<?php echo $row['username']?>" placeholder="Username">
            <br><br>
            <label>Password: </label>
            <br>
            <input type="password" name="Password" value="<?php echo $row['password']?>" placeholder="Password">
            <br><br>
            <input type="submit" value="Submit" name="Create">
        </form>
        </div>
    </div>
  </div>
        

    </div>
    

</body>
</html>