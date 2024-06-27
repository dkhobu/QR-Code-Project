<?php

session_start();
include('../connection/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lap_number = $_POST["lap_number"];
    $reportMessage = $_POST["reportMessage"];
    $dept_id = $_POST["dept_id"];
    $reported_by = $_SESSION["username"];

    // Validate inputs
    if (!empty($lap_number) && !empty($reportMessage) && !empty($dept_id)) {
        // Insert report into database (assuming you have a reports table with columns: id, pc_number, report_message, dept_id, reported_by)
        $sql = "INSERT INTO laptopreports (lap_number, report_message, dept_id, reported_by) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $lap_number, $reportMessage, $dept_id, $reported_by);

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
    header("Location: success_page.php");
    exit(); // Exit to prevent further execution of the script
}

?>
