<?php
require 'resources/function/connection.php';
$conn = connect();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['Firstname'];
    $middle_name = $_POST['Middlename'];
    $last_name = $_POST['Lastname'];
    $section = $_POST['Section'];
    $lrn = $_POST['LRN'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $birthday = $_POST['Birthday'];
    $address = $_POST['Address'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];

  
    $query = mysqli_query($conn, "SELECT email FROM student WHERE email = '$email'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);       
            ?><script>
              alert("Email Already Taken");
            </script><?php
    }else{
        $sql = "INSERT INTO student 
        (first_name, middle_name, last_name, grade, section_id, lrn, gender, email, birthday, address, username, password, status) 
        VALUES ('$first_name', '$middle_name', '$last_name', '10', '$section', '$lrn', '$gender', '$email', '$birthday', '$address', '$username', '$password', 'Pending')";
        $query = mysqli_query($conn, $sql);
        if($query){
        $query = mysqli_query($conn, "SELECT student_id FROM student WHERE username = '$username'");
        $row = mysqli_fetch_assoc($query);
        $_SESSION['student_id'] = $row['student_id'];
        header("location:studentdashboard.php");
     }
    }
    
    
}
$sectionsql = "SELECT * FROM section";
    $result = mysqli_query($conn, $sectionsql);
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
            <label>Section: </label>
            <br>
            <select name="Section">
				<?php while($row = mysqli_fetch_array($result)):;?>
            		<option value="<?php echo $row['section_id'];?>"><?php echo $row['section_name'];?></option>
            		<?php endwhile;?>
			  </select>
            </select>
            <br><br>
            <label>LRN: </label>
            <br>
            <input type="text" name="LRN" placeholder="LRN">
            <br><br>
            <label for="Gender">Gender: </label>
            <br>
            <select name="Gender" id="Gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
            <br><br>
            <label>Email: </label>
            <br>
            <input type="text" name="Email" placeholder="Email">
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


</body>
</html>