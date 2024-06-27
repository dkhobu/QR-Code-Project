<?php
session_start();


include('../connection/connect.php');

// Fetch all reports from the database
$query = "SELECT * FROM reports";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>View Reports</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>PC Number</th>
                <th>Dept ID</th>
                <th>Report Message</th>
                <th>Reported By</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['pc_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['dept_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['report_message']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['reported_by']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>
                            <a href='viewreport_details.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Update</a>
                            <a href='delete_report.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No reports found</td></tr>";
            }
            ?>
        </tbody>
    </table>
        <a href="../adminhome.php" class="btn btn-secondary">Back</a>
 
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
