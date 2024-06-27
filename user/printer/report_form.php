<?php
session_start();
include('../connection/connect.php');

// Fetch reports from the database
$sql = "SELECT id, pr_number, dept_id, report_message, reported_by FROM printerreports";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Reports</h1>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Pr Number</th>
                    <th>Dept ID</th>
                    <th>Report Message</th>
                    <th>Reported By</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['pr_number']); ?></td>
                        <td><?php echo htmlspecialchars($row['dept_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['report_message']); ?></td>
                        <td><?php echo htmlspecialchars($row['reported_by']); ?></td>
                        
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No reports found.</p>
    <?php endif; ?>
    
    <a href="report_device.php" class="btn btn-primary">Back to Report Device</a>
</div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>

