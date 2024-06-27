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
    $sql_fetch = "SELECT * FROM aetcomputers WHERE id = ?";
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
        $updates[] = "dept_id = 1";

        // Fetch pc_number
        $pc_number = $row['pc_number'];

        // Construct the update query
        $sql_update = "UPDATE aetcomputers SET " . implode(', ', $updates) . " WHERE id = ?";

        // Prepare and bind parameters dynamically
        $stmt_update = $conn->prepare($sql_update);
        $types = str_repeat('s', count($params)); // Assuming all parameters are strings
        $stmt_update->bind_param($types, ...$params);

        if ($stmt_update->execute()) {
            // Check if QR code already exists
            $qrCodeImagePath = $qrCodeDir . 'qr_image_' . $pc_number . '.png';
            if (!file_exists($qrCodeImagePath)) {
                // URL to be embedded in the QR code
                $url = "http://yingathungkikon.000.pe/user/computer/display_computer.php?pc_number=" . urlencode($pc_number) . "&dept_id=1";
                // Generate the QR code with the URL
                QRcode::png($url, $qrCodeImagePath);
                
                // Update the QR image path
                $sql_qr_update = "UPDATE aetcomputers SET qr_img = ? WHERE id = ?";
                $stmt_qr_update = $conn->prepare($sql_qr_update);
                $stmt_qr_update->bind_param("si", $qrCodeImagePath, $id);
                $stmt_qr_update->execute();
                $stmt_qr_update->close();
            }

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
    header("Location: add_computer.php");
    exit();
}

$conn->close();
?>
