<?php 


$student = "SELECT d.student_id, d.last_name, d.first_name,
d.middle_name, d.lrn,
d.status, c.section_name
FROM teacher a
JOIN lesson_plan b ON  a.teacher_id = b.teacher_id
JOIN section c ON b.section_id = c.section_id
JOIN student d ON b.section_id = d.section_id
WHERE a.teacher_id = $current_id
AND d.status = 'Pending'
ORDER BY d.last_name";

$result = $conn->query($student);

if ($result->num_rows > 0) {
    echo 
    "
    <table class='table-list table-to-refresh'>
    <tr>
    <th>Students</th>
    <th>LRN</th>
    <th>Status</th>
    <th>Verified</th>
    <th>Denied</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>                  
            <td align="center"><?php echo $row["last_name"] . ', ' . $row['first_name'] . '  ' . $row['middle_name']; ?></td>
            <td><?php echo $row["lrn"]?></td>
            <td><?php echo $row["status"]?></td>
            <td><button type='submit' name='verified' value="<?php echo $row['student_id'] ?>" onclick="reloadPage();" >Verified</button></td>
            <td><button type='submit' name='denied' value="<?php echo $row['student_id'] ?>" onclick="reloadPage();" >Denied</button></td>
      </tr><?php                
    }
    echo "</table>";
    } else {
    echo "0 results";
    }
?>