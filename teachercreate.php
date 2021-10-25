<?php
require 'resources/function/connection.php';
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['Firstname'];
    $middle_name = $_POST['Middlename'];
    $last_name = $_POST['Lastname'];
    $advisory_id = $_POST['AdvisoryClass'];
    $section_id = $_POST['AssignSection'];
    $subject_id = $_POST['Subject'];
    $contact_number = $_POST['ContactNumber'];
    $birthday = $_POST['Birthday'];
    $address = $_POST['Address'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "INSERT INTO teacher 
    (first_name, middle_name, last_name, contact_number, birthday, address, username, password) 
    VALUES ('$first_name', '$middle_name', '$last_name', '$contact_number', '$birthday', '$address', '$username', '$password')";
    $query = mysqli_query($conn, $sql);
    if($query){
      $query = mysqli_query($conn, "SELECT teacher_id FROM teacher WHERE username = '$username'");
      $row = mysqli_fetch_assoc($query);
      $_SESSION['teacher_id'] = $row['teacher_id'];
      $teacher_id = $row['teacher_id'];
      if($advisory_id != "NULL"){
        $sql1 = "INSERT INTO lesson_plan 
        (teacher_id, subject_id, advisory_section_id, section_id) 
        VALUES ('$teacher_id', '$subject_id', '$advisory_id', '$advisory_id')";
        $query1 = mysqli_query($conn, $sql1);
        if($query1){
            header("location:teacherdashboard.php");
        }
      }
      else{
        $sql1 = "INSERT INTO lesson_plan 
        (teacher_id, subject_id, section_id) 
        VALUES ('$teacher_id', '$subject_id', '$section_id')";
        $query1 = mysqli_query($conn, $sql1);
        if($query1){
            header("location:teacherdashboard.php");
        }
      }
      

      
    }
    
  }
    $sectionsql = "SELECT * FROM section";
    $result = mysqli_query($conn, $sectionsql);
    $section1sql = "SELECT * FROM section";
    $result1 = mysqli_query($conn, $section1sql);
    $subjectsql = "SELECT * FROM subject";
    $result2 = mysqli_query($conn, $subjectsql);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
<style>
    h2{
        text-align: center;
    }
    
</style>
</head>
<body>

<h2>Create an account</h2>
    <div class="container">
        <div class="content">
        <form method="post">   
            <label>First name: </label>
            <br>
            <input type="text" name="Firstname" placeholder="First name">
            <br><br>
            <label>Middle name: </label>
            <br>
            <input type="text" name="Middlename" placeholder="Middle name">
            <br><br>
            <label>Last name: </label>
            <br>
            <input type="text" name="Lastname" placeholder="Last name">
            <br><br>
            <label>Advisory Class: </label>
            <br>
            <select onchange="check()" name="AdvisoryClass" id="Advisory Class">
                    <option value="NULL">None</option>
				<?php while($row = mysqli_fetch_array($result)):;?>
            		<option value="<?php echo $row['section_id'];?>"><?php echo $row['section_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>Section Handle: </label>
            <br>
            <select name="AssignSection" id="Assign Section">
				<?php while($row1 = mysqli_fetch_array($result1)):;?>
            		<option value="<?php echo $row1['section_id'];?>"><?php echo $row1['section_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>Subject: </label>
            <br>
            <select name="Subject">
				<?php while($row2 = mysqli_fetch_array($result2)):;?>
            		<option value="<?php echo $row2['subject_id'];?>"><?php echo $row2['subject_name'];?></option>
            		<?php endwhile;?>
			  </select>
            <br><br>
            <label>Contact Number: </label>
            <br>
            <input type="text" name="ContactNumber" placeholder="Contact Number">
            <br><br>
            <label>Birthday: </label>
            <br>
            <input type="date" id="Birthday" name="Birthday">
            <br><br>
            <label>Address: </label>
            <br>
            <input type="text" name="Address" placeholder="Address">
            <br><br>
            <label>Username: </label>
            <br>
            <input type="text" name="Username" placeholder="Username">
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
</body>
</html>