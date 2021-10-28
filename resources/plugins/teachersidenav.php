<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];

?>
<?php
        if($row['advisory_section_id'] != null){?>
        <div class="sidenav">     
        <a href="teacherdashboard.php"> <i class="<?php if ($path=="/LAYOUT/teacherdashboard.php") {echo "active"; }?> far fa-id-card teacher-icons" aria-hidden="true" style="font-size:50px"></i><br>Advisory's Profile</a> 
        <a href="studentlist.php"> <i class="<?php if ($path=="/LAYOUT/studentlist.php") {echo "active"; }?> fas fa-clipboard-list teacher-icons" aria-hidden="true" style="font-size:50px"></i><br>Student List</a>
        <a href="teacherclearance.php"> <i class="<?php if ($path=="/LAYOUT/teacherclearance.php") {echo "active"; }?> fas fa-pen-square teacher-icons" aria-hidden="true" style="font-size:50px"></i><br>Clearance Form</a>
        <a href="verification.php"> <i class="<?php if ($path=="/LAYOUT/verification.php") {echo "active"; }?> fas fa-user-check" aria-hidden="true" style="font-size:50px"></i><br>Verification</a>
        <a href="teacheredit.php"> <i class="<?php if ($path=="/LAYOUT/teacheredit.php") {echo "active"; }?> fas fa-user-edit teacher-icons" style="font-size:50px"></i><br>Edit Profile</a>
        <a href="logout.php"> <i class="fas fa-sign-out-alt teacher-icons" style="font-size:50px"></i><br>Log Outs</a>
        </div>
     <?php   }
     else {?>
     <div class="sidenav"> 
         <a href="teacherdashboard.php"> <i class="<?php if ($path=="/LAYOUT/teacherdashboard.php") {echo "active"; }?> far fa-id-card teacher-icons" aria-hidden="true" style="font-size:50px"></i><br>Advisory's Profile</a> 
        <a href="studentlist.php"> <i class="<?php if ($path=="/LAYOUT/studentlist.php") {echo "active"; }?> fas fa-clipboard-list teacher-icons" aria-hidden="true" style="font-size:50px"></i><br>Student List</a>
        <a href="teacherclearance.php"> <i class="fas fa-pen-square teacher-icons" aria-hidden="true" style="font-size:50px"></i><br>Clearance Form</a>
        <a href="teacheredit.php"> <i class="<?php if ($path=="/LAYOUT/teacheredit.php") {echo "active"; }?> fas fa-user-edit teacher-icons" style="font-size:50px"></i><br>Edit Profile</a>
        <a href="logout.php"> <i class="fas fa-sign-out-alt teacher-icons" style="font-size:50px"></i><br>Log Outs</a>
        </div>
    <?php }

?>
