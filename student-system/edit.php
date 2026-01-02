<?php
include 'db.php';

// Get student ID from URL
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM students WHERE student_id = $id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];

    // Capture the old name for logging purposes
    $oldName = $row['full_name'];

    $sql = "UPDATE students SET full_name='$name', email='$email', course='$course', year_level='$year' WHERE student_id=$id";
    
    if ($conn->query($sql)) {
        // --- AUTOMATIC LOGGING START ---
        $log_action = "Updated details for student: " . $oldName;
        if ($oldName !== $name) {
            $log_action .= " (Name changed to: $name)";
        }
        $conn->query("INSERT INTO logs (action) VALUES ('$log_action')");
        // --- AUTOMATIC LOGGING END ---

        header("Location: index.php?msg=updated");
        exit();
    } else {
        echo "Error updating: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Students</a>
        <a href="user.php">Users</a> 
        <a href="log.php">Logs</a>
    </nav>

    <div class="container">
        <h2>Edit Student Details</h2>
        <form id="studentForm" method="POST" onsubmit="return validateForm()">
            <label>Full Name:</label>
            <input type="text" name="name" id="name" value="<?= $row['full_name'] ?>" required>
            
            <label>Email Address:</label>
            <input type="email" name="email" id="email" value="<?= $row['email'] ?>" required>
            
            <label>Course:</label>
            <input type="text" name="course" id="course" value="<?= $row['course'] ?>" required>
            
            <label>Year Level:</label>
            <input type="number" name="year" id="year" value="<?= $row['year_level'] ?>" required>
            
            <button type="submit" name="update">Update Student</button>
            <a href="index.php" class="back-btn">Cancel</a>
        </form>
    </div>
    <script src="validation.js"></script>
</body>
</html>
