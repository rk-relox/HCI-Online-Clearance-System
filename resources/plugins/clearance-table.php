<?php 


$student = "SELECT a.student_id, a.first_name, a.middle_name, a.last_name, a.lrn, b.remarks, b.comment
FROM student a 
JOIN clearance b ON b.student_id = a.student_id
JOIN lesson_plan c ON b.lesson_plan_id = b.lesson_plan_id
JOIN teacher d ON d.teacher_id = c.teacher_id
JOIN section e ON e.section_id = c.section_id
WHERE d.teacher_id = $current_id
AND a.section_id = $section_id
GROUP BY a.student_id";

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
            <td><button type='submit' name='verified' value="<?php echo $row['student_id'] ?>" >Edit</button></td>
      </tr><?php                
    }
    echo "</table>";
    } else {
    echo "0 results";
    }
?>