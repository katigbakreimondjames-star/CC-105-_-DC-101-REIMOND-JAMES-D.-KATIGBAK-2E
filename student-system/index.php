<?php 
include 'db.php'; 
$query = "SELECT * FROM students ORDER BY student_id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php">Students</a>
    <a href="user.php">Users</a> 
    <a href="log.php">Logs</a>
</nav>

<div class="container">
    <h2>Student List</h2>
    
    <?php if(isset($_GET['msg'])): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px; text-align: center;">
            Action Completed Successfully!
        </div>
    <?php endif; ?>

    <div style="margin-bottom: 20px;">
        <a href="add.php" class="btn-add">+ Add New Student</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['year_level']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['student_id']; ?>" style="color: #007bff; text-decoration: none;">Edit</a> | 
                            <a href="delete.php?id=<?php echo $row['student_id']; ?>" 
                               style="color: #dc3545; text-decoration: none;" 
                               onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No records found in the Students table.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="validation.js"></script>

</body>
</html>
