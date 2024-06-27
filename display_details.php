<?php
session_start();
include('connection/connect.php');

// Check if pc_number is set in the GET request
if (isset($_GET['pc_number'])) {
    $pc_number = $_GET['pc_number'];

    // Prepared statement to prevent SQL injection
    $query = "SELECT c.*, d.dept_name 
              FROM computers c 
              JOIN departments d ON c.dept_id = d.dept_id 
              WHERE c.pc_number = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $pc_number);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>No details found for this PC number.</p>";
            $stmt->close();
            $conn->close();
            exit();
        }
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt->close();
} else {
    echo "<p>No device PC number provided.</p>";
    $conn->close();
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Device Details</h1>
    <?php if ($row) : ?>
        <p><strong>Device Name:</strong> <?php echo htmlspecialchars($row['device_name']); ?></p>
        <p><strong>Brand:</strong> <?php echo htmlspecialchars($row['brand']); ?></p>
        <p><strong>PC Number:</strong> <?php echo htmlspecialchars($row['pc_number']); ?></p>
        <p><strong>Processor:</strong> <?php echo htmlspecialchars($row['processor']); ?></p>
        <p><strong>RAM:</strong> <?php echo htmlspecialchars($row['ram']); ?></p>
        <p><strong>System Type:</strong> <?php echo htmlspecialchars($row['system_type']); ?></p>
        <p><strong>Pen Touch:</strong> <?php echo htmlspecialchars($row['pen_touch']); ?></p>
        <p><strong>Problem:</strong> <?php echo htmlspecialchars($row['problem']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($row['dept_name']); ?></p>
    <?php else : ?>
        <p>No details found for this PC number.</p>
    <?php endif; ?>

    <!-- Report Button -->
    <button type="button" class="btn btn-danger" onclick="handleReportClick()">Report</button>
</div>

<script>
function handleReportClick() {
    <?php if (!isset($_SESSION["username"])) { ?>
        // User is not logged in, redirect to the login page
        window.location.href = 'login.php';
    <?php } else { ?>
        // User is logged in, redirect to the report page
        window.location.href = 'report_device.php?pc_number=<?php echo htmlspecialchars($pc_number); ?>';
    <?php } ?>
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
