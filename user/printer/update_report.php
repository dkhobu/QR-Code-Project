<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include('../connection/connect.php');

// Check if the report ID is set in the GET request
if (isset($_GET['id'])) {
    $report_id = $_GET['id'];

    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM printerreports WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $report_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>No report details found for this ID.</p>";
            exit();
        }
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
        exit();
    }

    $stmt->close();
} else {
    echo "<p>No report ID provided.</p>";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pr_number = $_POST['pr_number'];
    $device_type = $_POST['dept_id'];
    $report_message = $_POST['report_message'];
    $status = $_POST['status'];

    // Update the report details in the database
    $update_query = "UPDATE printerreports SET pr_number = ?, dept_id = ?, report_message = ?, status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    if ($update_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $update_stmt->bind_param("ssssi", $pr_number, $device_type, $report_message, $status, $report_id);

    if ($update_stmt->execute()) {
        header("Location: view_reports.php"); // Redirect to the reports page
        exit();
    } else {
        echo "Error: " . htmlspecialchars($update_stmt->error);
    }

    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Report Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Update Report Details</h1>
    <form method="POST">
        <div class="form-group">
            <label for="pr_number">Pr Number:</label>
            <input type="text" class="form-control" id="pr_number" name="pr_number" value="<?php echo htmlspecialchars($row['pr_number']); ?>" required>
        </div>
        <div class="form-group">
            <label for="device_type">Device Type:</label>
            <input type="text" class="form-control" id="dept_id" name="dept_id" value="<?php echo htmlspecialchars($row['dept_id']); ?>" required>
        </div>
        <div class="form-group">
            <label for="report_message">Report Message:</label>
            <textarea class="form-control" id="report_message" name="report_message" rows="3" required><?php echo htmlspecialchars($row['report_message']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="In Progress" <?php if($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Completed" <?php if($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Report</button>
        <a href="view_reports.php" class="btn btn-secondary">Back to Reports</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
