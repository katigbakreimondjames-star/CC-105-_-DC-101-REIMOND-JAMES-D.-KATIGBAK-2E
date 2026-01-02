<?php 
include 'db.php'; 
// Fetches from the 'logs' table in your database
$result = $conn->query("SELECT * FROM logs ORDER BY action_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity Logs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php">Students</a>
    <a href="user.php">Users</a> 
    <a href="log.php">Logs</a>
</nav>

<div class="container">
    <h2>Activity Logs</h2>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <a href="log.php" class="btn-add" style="
            background-color: #007bff; 
            color: white; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 4px; 
            display: inline-block; 
            font-weight: bold;
        ">↻ Refresh Logs</a>

        <a href="clear_logs.php" class="btn-add" style="
            background-color: #dc3545; 
            color: white; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 4px; 
            display: inline-block; 
            font-weight: bold;
        " onclick="return confirm('Warning: This will permanently delete all activity logs. Continue?')">🗑 Clear All Logs</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Log ID</th>
                <th>Action Description</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['log_id']}</td>
                            <td>{$row['action']}</td>
                            <td>{$row['action_date']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3' style='text-align:center;'>No activity logs found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>