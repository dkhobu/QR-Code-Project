<?php
session_start();
include('../../../connection/connect.php');
require_once '../../../../phpqrcode/qrlib.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    
    // Ensure the directory exists
    $qrCodeDir = '../image/';
    if (!is_dir($qrCodeDir)) {
        mkdir($qrCodeDir, 0755, true);
    }

    // Fetch existing record from the database
    $sql_fetch = "SELECT * FROM btlaptops WHERE id = ?";
    $stmt_fetch = $conn->prepare($sql_fetch);
    $stmt_fetch->bind_param("i", $id);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // Retrieve existing details
        $updates = [];
        $params = [];
        foreach ($row as $key => $value) {
            if ($key != 'id') {
                if(isset($_POST[$key])) {
                    $updates[] = "$key = ?";
                    $params[] = $_POST[$key];
                } else {
                    $updates[] = "$key = ?";
                    $params[] = $value;
                }
            }
        }
        // Append the ID to the params array
        $params[] = $id;

        // Add dept_id to updates array
        $updates[] = "dept_id = 2";

        // Fetch lap_number
        $lap_number = $row['lap_number'];

        // Construct the update query
        $sql_update = "UPDATE btlaptops SET " . implode(', ', $updates) . " WHERE id = ?";

        // Prepare and bind parameters dynamically
        $stmt_update = $conn->prepare($sql_update);
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings
        $stmt_update->bind_param($types, ...$params);

        if ($stmt_update->execute()) {
            // URL to be embedded in the QR code
            $url = "http://yingathungkikon.000.pe/user/laptop/display_laptop.php?lap_number=" . urlencode($lap_number) . "&dept_id=2";
            // Generate the QR code with the URL
            $qrCodeImagePath = $qrCodeDir . 'qr_image_' . $lap_number . '.png';
            QRcode::png($url, $qrCodeImagePath);
            
            // Update the QR image path
            $sql_qr_update = "UPDATE btlaptops SET qr_img = ? WHERE id = ?";
            $stmt_qr_update = $conn->prepare($sql_qr_update);
            $stmt_qr_update->bind_param("si", $qrCodeImagePath, $id);
            $stmt_qr_update->execute();
            $stmt_qr_update->close();

            header("Location: ../pages/adminview.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt_update->error;
        }

        $stmt_update->close();
    } else {
        echo "Record not found.";
    }

    $stmt_fetch->close();
} else {
    // Redirect if not a POST request
    header("Location: add_laptop.php");
    exit();
}

$conn->close();
?>
