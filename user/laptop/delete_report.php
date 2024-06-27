<?php
session_start();


include('../connection/connect.php');

// Check if the report ID is set in the GET request
if (isset($_GET['id'])) {
    $report_id = $_GET['id'];

    // Prepared statement to prevent SQL injection
    $query = "DELETE FROM laptopreports WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("i", $report_id);

    if ($stmt->execute()) {
        header("Location: view_reports.php"); // Redirect to the reports page
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "<p>No report ID provided.</p>";
}

$conn->close();
?>
