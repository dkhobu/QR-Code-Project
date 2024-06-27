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
    <?php
        session_start();
        include('../connection/connect.php');

        // Check if lap_number and dept_id are set in the GET request
        if (isset($_GET['lap_number']) && isset($_GET['dept_id'])) {
            $lap_number = $_GET['lap_number'];
            $dept_id = $_GET['dept_id']; // Fetch dept_id from the URL

            // Set the lap_number and dept_id in the session
            $_SESSION['lap_number'] = $lap_number;
            $_SESSION['dept_id'] = $dept_id;

            // Array to store department table names
            $department_tables = ['aetlaptops', 'btlaptops', 'cselaptops', 'ecelaptops', 'itlaptops'];

            // Flag to check if computer details were found
            $computer_found = false;

            // Loop through each department table to find the computer
            foreach ($department_tables as $table) {
                // Fetch computer details from the current department's table
                $query_details = "SELECT * FROM $table WHERE lap_number = ? AND dept_id = ?";
                $stmt_details = $conn->prepare($query_details);
                $stmt_details->bind_param("ss", $lap_number, $dept_id);

                if ($stmt_details->execute()) {
                    $result_details = $stmt_details->get_result();
                    if ($result_details->num_rows > 0) {
                        $row_details = $result_details->fetch_assoc();
                        // Display computer details
                        echo "<h1>Device Details</h1>";
                        foreach ($row_details as $key => $value) {
                            echo "<p><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</p>";
                        }
                        // Report Button with lap_number and dept_id as parameters in the URL
                        echo '<a href="login.php?lap_number=' . urlencode($lap_number) . '&dept_id=' . urlencode($dept_id) . '" class="btn btn-danger">Report</a>';
                        // Set flag to true
                        $computer_found = true;
                        // Exit loop after finding the computer
                        break;
                    }
                } else {
                    echo "Error fetching computer details: " . htmlspecialchars($stmt_details->error);
                }
                $stmt_details->close();
            }

            // Check if computer details were found
            if (!$computer_found) {
                echo "<p>No details found for this lap number in the department.</p>";
            }
        } else {
            echo "<p>lap number and department ID are required.</p>";
        }

        $conn->close();
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
