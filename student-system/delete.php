<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Security: ensures the ID is a number

    // 1. Get the student's name BEFORE deleting so we can log it
    $nameQuery = "SELECT full_name FROM students WHERE student_id = $id";
    $nameResult = $conn->query($nameQuery);
    
    $studentName = "Unknown Student"; // Default if not found
    if ($nameResult && $nameResult->num_rows > 0) {
        $row = $nameResult->fetch_assoc();
        $studentName = $row['full_name'];
    }

    // 2. Perform the deletion
    $sql = "DELETE FROM students WHERE student_id = $id";

    if ($conn->query($sql)) {
        
        // 3. --- AUTOMATIC LOGGING START ---
        $log_action = "Deleted student: " . $studentName . " (ID: $id)";
        $conn->query("INSERT INTO logs (action) VALUES ('$log_action')");
        // --- AUTOMATIC LOGGING END ---

        header("Location: index.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: index.php");
}
?>
