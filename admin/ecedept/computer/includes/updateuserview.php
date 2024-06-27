<?php
include('../../../connection/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $computerId = $_POST['computerId'];
    $reportDetails = $_POST['reportDetails'];

    $sql = "UPDATE aetcomputers SET problem = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $reportDetails, $computerId);

    if ($stmt->execute()) {
        // Send an email to the admin
        $adminEmail = "yingathungk@gmail.com"; 
        $subject = "New Report Submitted for Computer ID $computerId";
        $message = "A new report has been submitted for the following computer:\n\n" .
                   "Computer ID: $computerId\n" .
                   "Report Details: $reportDetails";
        $headers = "From: yingathungk@gmail.com"; 

        if (mail($adminEmail, $subject, $message, $headers)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send email.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update database.']);
    }

    $stmt->close();
    $conn->close();
}
?>
