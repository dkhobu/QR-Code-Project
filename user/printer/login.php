<?php
session_start();
include('../connection/connect.php');

// Fetch the pr_number and dept_id from the session or URL
$pr_number = $_SESSION['pr_number'] ?? $_GET['pr_number'] ?? '';
$dept_id = $_SESSION['dept_id'] ?? $_GET['dept_id'] ?? '';

// Check for required fields
if (empty($pr_number)) {
    $_SESSION["error_message"] = "pr number is required.";
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
        $sql = "INSERT INTO printerreports (pr_number, dept_id, report_message, reported_by) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $_SESSION["error_message"] = "Error preparing statement: " . $conn->error;
            header("Location: error_page.php");
            exit();
        }

        $stmt->bind_param("ssss", $pr_number, $dept_id, $reportMessage, $username);

        if ($stmt->execute()) {
            // Fetch department name based on dept_id
            $sql_printers = "SELECT printers FROM departments WHERE dept_id = ?";
            $stmt_printers = $conn->prepare($sql_printers);
            $stmt_printers->bind_param("s", $dept_id);
            $stmt_printers->execute();
            $stmt_printers->bind_result($printers);
            $stmt_printers->fetch();
            $stmt_printers->close();

            // Check if department name is retrieved successfully
            if (empty($printers)) {
                $_SESSION["error_message"] = "Department not found.";
                header("Location: error_page.php");
                exit();
            }

            // Update the problem column in the department-specific table
            $update_sql = "UPDATE {$printers} SET problem = ? WHERE pr_number = ?";
            $update_stmt = $conn->prepare($update_sql);
            if ($update_stmt === false) {
                $_SESSION["error_message"] = "Error preparing update statement: " . $conn->error;
                header("Location: error_page.php");
                exit();
            }

            $update_stmt->bind_param("ss", $reportMessage, $pr_number);

            if ($update_stmt->execute()) {
                // Update successful
                $_SESSION["success_message"] = "Report submitted and printer problem updated successfully.";
                header("Location: success_page.php");
                exit();
            } else {
                // Error updating printer problem
                $_SESSION["error_message"] = "Error updating printer problem: " . $update_stmt->error;
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
                        <!-- Add hidden input fields to include the pr number and dept_id -->
                        <input type="hidden" name="pr_number" value="<?php echo htmlspecialchars($pr_number); ?>">
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
