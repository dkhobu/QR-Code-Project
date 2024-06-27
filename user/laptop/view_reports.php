<?php
session_start();
include('../connection/connect.php');

// Fetch column names dynamically
$query = "SHOW COLUMNS FROM laptopreports";
$columnsResult = $conn->query($query);

$columns = [];
if ($columnsResult->num_rows > 0) {
    while($row = $columnsResult->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
}

// Fetch all reports from the database
$query = "SELECT * FROM laptopreports";
$result = $conn->query($query);
?>
<?php require '../main/header.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-wrapper {
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table-title {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container table-wrapper">
    <h1 class="text-center">Laptop Reports</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th><?php echo strtoupper(str_replace('_', ' ', $column)); ?></th>
                    <?php endforeach; ?>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <td><?php echo htmlspecialchars($row[$column]); ?></td>
                            <?php endforeach; ?>
                            <td>
                                <a href='viewreport_details.php?id=<?php echo $row['id']; ?>' class='btn btn-info btn-sm mr-1'>Update</a>
                                <a href='delete_report.php?id=<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' onclick='return confirm("Are you sure?")'>Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan='<?php echo count($columns) + 1; ?>' class="text-center">No reports found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="text-right">
        <a href="../../adminhome.php" class="btn btn-secondary">Back</a>
    </div>
</div>
<?php require '../main/footer.php'?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
