<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Optional: Get username for logging
    $userResult = $conn->query("SELECT username FROM users WHERE user_id = $id");
    $userData = $userResult->fetch_assoc();
    $username = $userData['username'];

    if ($conn->query("DELETE FROM users WHERE user_id = $id")) {
        // Log the deletion
        $conn->query("INSERT INTO logs (action) VALUES ('Deleted user: $username')");
        header("Location: user.php");
    }
}
?>