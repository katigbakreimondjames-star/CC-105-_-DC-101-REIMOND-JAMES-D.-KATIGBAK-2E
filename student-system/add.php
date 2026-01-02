<?php
include 'db.php';

if (isset($_POST['add'])) {
    
    // Get values from form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $year = $_POST['year'];

    // Insert into Students table
    $sql = "INSERT INTO students (full_name, email, course, year_level) 
            VALUES ('$name', '$email', '$course', '$year')";

    if ($conn->query($sql) === TRUE) {
        
        // --- AUTOMATIC LOGGING START ---
        // This inserts a record into your logs table automatically
        $log_action = "Added new student: " . $name;
        $conn->query("INSERT INTO logs (action) VALUES ('$log_action')");
        // --- AUTOMATIC LOGGING END ---

        header("Location: index.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Students</a>
        <a href="user.php">Users</a> 
        <a href="log.php">Logs</a>
    </nav>

    <div class="container">
        <h2>Add New Student</h2>
        <form method="POST" action="add.php">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="course" placeholder="Course" required>
            <input type="number" name="year" placeholder="Year Level" required>
            <button type="submit" name="add">Add Student</button>
            <a href="index.php" class="back-btn">Cancel and Go Back</a>
        </form>
    </div>
</body>
</html>
