<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];

?>
<div class="sidenav">     
    <a href="studentdashboard.php" > <i class="<?php if ($path=="/LAYOUT/studentdashboard.php") {echo "active"; }?> far fa-id-card" aria-hidden="true" style="font-size:80px"></i>Student Profile</a>   
    <a href="studentclearance.php" class="<?php if ($row['status']!="Verified") {echo "disabled"; }?>"> <i class="<?php if ($path=="/LAYOUT/studentclearance.php") {echo "active"; }?> fas fa-pen-square" aria-hidden="true" style="font-size:80px"></i>Clearance Form</a>
    <a href="studentedit.php"> <i class="<?php if ($path=="/LAYOUT/studentedit.php") {echo "active"; }?> fas fa-user-edit" aria-hidden="true" style="font-size:80px"></i>Edit Profile</a>
    <a href="logout.php"> <i class=" fas fa-sign-out-alt teacher-icons" style="font-size:50px"></i><br>Log Outs</a>
</div>