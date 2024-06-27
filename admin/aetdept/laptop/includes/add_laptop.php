<?php
session_start();
include('../../../connection/connect.php');
require_once '../../../../phpqrcode/qrlib.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $data = array_map('trim', $_POST); // Trim white spaces
    $data = array_map('htmlspecialchars', $data); // Convert special characters to HTML entities

    $dept_id = 1; 
    // Ensure the directory exists
    $qrCodeDir = '../image/';
    if (!is_dir($qrCodeDir)) {
        mkdir($qrCodeDir, 0755, true);
    }

    // Generate QR Code image path
    $lap_number = $data['lap_number'];
    $qrCodeImagePath = $qrCodeDir . $lap_number . '.png';

    // Generate the URL
    $url = "http://yingathungkikon.000.pe/user/laptop/display_laptop.php?lap_number=" . urlencode($lap_number) . "&dept_id=" . urlencode($dept_id);

    // Generate QR Code with the URL
    QRcode::png($url, $qrCodeImagePath);

    // Prepare the column names and placeholders for the SQL INSERT statement
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));

    // Prepare the SQL INSERT statement
    $insert_sql = "INSERT INTO aetlaptops ($columns, qr_img) VALUES ($placeholders, ?)";

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
