<?php
session_start();
include('../../../connection/connect.php');
require_once '../../../../phpqrcode/qrlib.php';

error_reporting(E_ALL);
ini_set('display_errors', 4);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST; // Assuming form fields are submitted with the same names as the columns in the table
    $dept_id = 1; 
    // Ensure the directory exists
    $qrCodeDir = '../image/';
    if (!is_dir($qrCodeDir)) {
        mkdir($qrCodeDir, 0755, true);
    }

    // Generate QR Code image path
    $pc_number = $data['pc_number'];
    $qrCodeImagePath = $qrCodeDir . $pc_number . '.png';

    // Generate the URL
    $url = "http://yingathungkikon.000.pe/user/computer/display_computer.php?pc_number=" . urlencode($pc_number) . "&dept_id=" . urlencode($dept_id);

    // Generate QR Code with the URL
    QRcode::png($url, $qrCodeImagePath);

    // Prepare the column names and placeholders for the SQL INSERT statement
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));

    // Prepare the SQL INSERT statement
    $insert_sql = "INSERT INTO ececomputers ($columns, qr_img) VALUES ($placeholders, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($insert_sql);

    if (!$stmt) {
        die("Error in preparing SQL statement: " . $conn->error);
    }

    // Bind parameters dynamically
    $types = str_repeat('s', count($data)); // Assuming all columns are strings
    $values = array_values($data);
    $values[] = $qrCodeImagePath; // Append QR image path to values
    $bind_result = $stmt->bind_param($types . 's', ...$values); // Bind types and values

    if (!$bind_result) {
        die("Error in binding parameters: " . $stmt->error);
    }

    // Execute the statement
    $execute_result = $stmt->execute();
            if ($execute_result) {
                // Redirect to the admin home page on success
                header("Location: ../pages/adminview.php");
                exit(); // Make sure to exit after redirection
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close(); // Close the prepared statement
            $conn->close(); // Close the database connection
} else {
    echo "Invalid request method.";
}
?>
