<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include('../connection/connect.php');

// Debugging: Output all GET parameters
echo '<pre>';
print_r($_GET);
echo '</pre>';

// Check if pc_number is set in the GET request
if (isset($_GET['pc_number'])) {
    $pc_number = $_GET['pc_number'];
    echo "PC Number provided: " . htmlspecialchars($pc_number) . "<br>"; // Debugging line

    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM aetcomputers WHERE pc_number = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("s", $pc_number);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $dept_id = $row['dept_id']; // Fetch dept_id from the database
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
    <p><strong>Device Name:</strong> <?php echo htmlspecialchars($row['device_name']); ?></p>
    <p><strong>Brand:</strong> <?php echo htmlspecialchars($row['brand']); ?></p>
    <p><strong>PC Number:</strong> <?php echo htmlspecialchars($row['pc_number']); ?></p>
    <p><strong>Processor:</strong> <?php echo htmlspecialchars($row['processor']); ?></p>
    <p><strong>RAM:</strong> <?php echo htmlspecialchars($row['ram']); ?></p>
    <p><strong>System Type:</strong> <?php echo htmlspecialchars($row['system_type']); ?></p>
    <p><strong>Pen Touch:</strong> <?php echo htmlspecialchars($row['pen_touch']); ?></p>
    <p><strong>Problem:</strong> <?php echo htmlspecialchars($row['problem']); ?></p>

    <!-- Report Button -->
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reportModal">Report</button>

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report Device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="reportForm" method="POST" action="report_device.php">
                        <div class="form-group">
                            <label for="reportMessage">Message</label>
                            <textarea class="form-control" id="reportMessage" name="reportMessage" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="pc_number" value="<?php echo htmlspecialchars($row['pc_number']); ?>">
                        <input type="hidden" name="dept_id" value="<?php echo htmlspecialchars($dept_id); ?>"> <!-- Add dept_id -->
                        <button type="submit" class="btn btn-primary">Send Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
        } else {
            echo "<p>No details found for this device.</p>";
        }
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "<p>No device PC number provided.</p>";
}

$conn->close();
?>