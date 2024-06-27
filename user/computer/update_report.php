<?php
session_start();

include('../connection/connect.php');

// Check if the report ID is set in the GET request
if (isset($_GET['id'])) {
    $report_id = $_GET['id'];

    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM reports WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $report_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $dept_id = $row['dept_id']; // Get dept ID for dynamic update
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
    $pc_number = $_POST['pc_number'];
    $device_type = $_POST['dept_id'];
    $report_message = $_POST['report_message'];
    $status = $_POST['status'];

    // Update the report details in the database
    $update_query = "UPDATE reports SET pc_number = ?, dept_id = ?, report_message = ?, status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    if ($update_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Determine the report message based on the status
    if ($status == 'Completed') {
        $report_message = 'No problem';

        // Get the dept name associated with dept_id
        $get_dept_query = "SELECT dept_name FROM departments WHERE id = ?";
        $get_dept_stmt = $conn->prepare($get_dept_query);
        if ($get_dept_stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $get_dept_stmt->bind_param("i", $dept_id);
        if ($get_dept_stmt->execute()) {
            $result = $get_dept_stmt->get_result();
            if ($result->num_rows > 0) {
                $dept = $result->fetch_assoc();
                $dept_name = $dept['dept_name'];
                // Construct the update query dynamically
                $update_problem_query = "UPDATE $dept_name SET problem = ? WHERE id = ?";
                $update_problem_stmt = $conn->prepare($update_problem_query);
                if ($update_problem_stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }
                $no_problem = 'No problem';
                $update_problem_stmt->bind_param("si", $no_problem, $report_id);
                if (!$update_problem_stmt->execute()) {
                    echo "Error updating problem column: " . htmlspecialchars($update_problem_stmt->error);
                    exit();
                }
                $update_problem_stmt->close();
            } else {
                echo "<p>Dept details not found.</p>";
                exit();
            }
        } else {
            echo "Error: " . htmlspecialchars($get_dept_stmt->error);
            exit();
        }
        $get_dept_stmt->close();
    }

    // Bind parameters and execute the update statement
    $update_stmt->bind_param("sssii", $pc_number, $device_type, $report_message, $status, $report_id);
    if ($update_stmt->execute()) {
        echo "<p>Report details updated successfully.</p>";
        header("Location: view_reports.php"); // Redirect to the reports page
        exit();
    } else {
        echo "Error updating report details: " . htmlspecialchars($update_stmt->error);
    }

    $update_stmt->close();
}

$conn->close();
?>

<?php require '../main/header.php'; ?>
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
    <h1 class="text-center">Update Report Details</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST">
                <div class="form-group">
                    <label for="pc_number">PC Number:</label>
                    <input type="text" class="form-control" id="pc_number" name="pc_number" value="<?php echo htmlspecialchars($row['pc_number']); ?>" required>
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
    </div>
</div>
<?php require '../main/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr
