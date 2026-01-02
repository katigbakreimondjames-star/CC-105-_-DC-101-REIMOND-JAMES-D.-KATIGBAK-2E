<?php
include 'db.php';

// TRUNCATE empties the entire table and resets the Log ID to 1
$sql = "TRUNCATE TABLE logs";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the logs page with a message
    header("Location: log.php?msg=cleared");
    exit();
} else {
    echo "Error clearing logs: " . $conn->error;
}
?>