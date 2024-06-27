<?php

session_start();
include('../connection/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pc_number = $_POST["pc_number"];
    $reportMessage = $_POST["reportMessage"];
    $dept_id = $_POST["dept_id"];
    $reported_by = $_SESSION["username"];

    // Validate inputs
    if (!empty($pc_number) && !empty($reportMessage) && !empty($dept_id)) {
        // Insert report into database (assuming you have a reports table with columns: id, pc_number, report_message, dept_id, reported_by)
        $sql = "INSERT INTO reports (pc_number, report_message, dept_id, reported_by) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $pc_number, $reportMessage, $dept_id, $reported_by);

        if ($stmt->execute()) {
            $_SESSION["success_message"] = "Report submitted successfully.";
        } else {
            $_SESSION["error_message"] = "Error submitting report: " . $stmt->error;
        }
        $stmt->close(); // Close the prepared statement
    } else {
        $_SESSION["error_message"] = "All fields are required.";
    }
    $conn->close(); // Close the database connection

    header("Location: report_device.php?pc_number=" . urlencode($pc_number) . "&dept_id=" . urlencode($dept_id));
    exit(); // Exit to prevent further execution of the script
}

// Display reported successfully message if set
if (isset($_SESSION["success_message"])) {
    echo "<p>Report submitted successfully: " . $_SESSION["success_message"] . "</p>";
    unset($_SESSION["success_message"]); // Clear success message after displaying
}

?>
