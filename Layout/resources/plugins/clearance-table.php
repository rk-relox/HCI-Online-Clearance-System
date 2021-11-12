<?php 


$student = "SELECT a.student_id, a.first_name, a.middle_name, a.last_name, a.lrn, b.remarks, b.comment
FROM student a 
JOIN clearance b ON a.student_id = b.student_id
JOIN lesson_plan c ON b.lesson_plan_id = c.lesson_plan_id
JOIN teacher d ON c.teacher_id = d.teacher_id
WHERE d.teacher_id = $current_id";

$result = $conn->query($student);

if ($result->num_rows > 0) {
    echo 
    "
    <table class='table-list table-to-refresh'>
    <tr>
    <th>Students</th>
    <th>LRN</th>
    <th>Remarks</th>
    <th>Comment</th>
    <th>Edit</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) { ?> 
                            
            <td align="center"><?php echo $row["last_name"] . ', ' . $row['first_name'] . '  ' . $row['middle_name']; ?></td>
            <td><?php echo $row["lrn"]?></td>
            <td><?php echo $row["remarks"]?></td>
            <td><?php echo $row["comment"]?></td>
            <td><a href="clearance-edit.php?student_id=<?php echo $row["student_id"]; ?>">Edit</a></td>
      </tr><?php                
    }
    echo "</table>";
    } else {
    echo "0 results";
    }
?>