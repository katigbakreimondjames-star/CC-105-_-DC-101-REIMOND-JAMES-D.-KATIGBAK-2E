<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        // Record this action in the logs
        $conn->query("INSERT INTO logs (action) VALUES ('Registered new user: $username')");
        
        // Redirect back to user.php
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register New User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Students</a>
        <a href="user.php">Users</a> 
        <a href="log.php">Logs</a>
    </nav>

    <div class="container">
        <h2>Register New User</h2>
        <form method="POST" action="add_user.php" onsubmit="return validateForm()">
            <label>Username</label>
            <input type="text" name="username" id="name" placeholder="Enter username" required>
            
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            
            <button type="submit" name="register">Register User</button>
            <a href="user.php" class="back-btn">Cancel and Go Back</a>
        </form>
    </div>

    <script src="validation.js"></script>
</body>
</html>