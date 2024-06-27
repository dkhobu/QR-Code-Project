<?php
session_start();
include('../connection/connect.php');

// Fetch the lap_number and dept_id from the session or URL
$lap_number = $_SESSION['lap_number'] ?? $_GET['lap_number'] ?? '';
$dept_id = $_SESSION['dept_id'] ?? $_GET['dept_id'] ?? '';

// Check for required fields
if (empty($lap_number)) {
    $_SESSION["error_message"] = "Lap number is required.";
    header("Location: error_page.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $reportMessage = $_POST["report"];

    // Validate inputs
    if (empty($username)) {
        $_SESSION["error_message"] = "Username is required.";
    } elseif (empty($password)) {
        $_SESSION["error_message"] = "Password is required.";
    } elseif (empty($reportMessage)) {
        $_SESSION["error_message"] = "Report message is required.";
    } else {
        // Proceed with report submission
        $sql = "INSERT INTO laptopreports (lap_number, dept_id, report_message, reported_by) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $_SESSION["error_message"] = "Error preparing statement: " . $conn->error;
            header("Location: error_page.php");
            exit();
        }

        $stmt->bind_param("ssss", $lap_number, $dept_id, $reportMessage, $username);

        if ($stmt->execute()) {
            // Fetch department name based on dept_id
            $sql_laptops = "SELECT laptops FROM departments WHERE dept_id = ?";
            $stmt_laptops = $conn->prepare($sql_laptops);
            $stmt_laptops->bind_param("s", $dept_id);
            $stmt_laptops->execute();
            $stmt_laptops->bind_result($laptops);
            $stmt_laptops->fetch();
            $stmt_laptops->close();

            // Check if department name is retrieved successfully
            if (!$laptops) {
                $_SESSION["error_message"] = "Department not found.";
                header("Location: error_page.php");
                exit();
            }

            // Update the problem column in the department-specific table
            $update_sql = "UPDATE {$laptops} SET problem = ? WHERE lap_number = ?";
            $update_stmt = $conn->prepare($update_sql);
            if ($update_stmt === false) {
                $_SESSION["error_message"] = "Error preparing update statement: " . $conn->error;
                header("Location: error_page.php");
                exit();
            }

            $update_stmt->bind_param("ss", $reportMessage, $lap_number);

            if ($update_stmt->execute()) {
                // Update successful
                $_SESSION["success_message"] = "Report submitted and laptop problem updated successfully.";
                header("Location: success_page.php");
                exit();
            } else {
                // Error updating laptop problem
                $_SESSION["error_message"] = "Error updating laptop problem: " . $update_stmt->error;
                header("Location: error_page.php");
                exit();
            }
        } else {
            // Error submitting report
            $_SESSION["error_message"] = "Error submitting report: " . $stmt->error;
            header("Location: error_page.php");
            exit();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Report</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION["error_message"])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION["error_message"]; unset($_SESSION["error_message"]); ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <!-- Add a hidden input field to include the Lap number -->
                        <input type="hidden" name="lap_number" value="<?php echo htmlspecialchars($lap_number); ?>">
                        <input type="hidden" name="dept_id" value="<?php echo htmlspecialchars($dept_id); ?>">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="report">Report:</label>
                            <textarea class="form-control" id="report" name="report" required></textarea>
                        </div>
                        <button type="submit" name="submit_report" class="btn btn-primary btn-block">Submit</button>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
