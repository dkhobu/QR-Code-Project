<?php
session_start();
include('../../../connection/connect.php');

// Fixed department ID
$dept_id = 4;

// Fetch current columns in the table dynamically
$columnsResult = $conn->query("SHOW COLUMNS FROM `eceprinters`");
$columns = [];
if ($columnsResult->num_rows > 0) {
    while ($row = $columnsResult->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
}

$sql = "SELECT * FROM eceprinters";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Update Inventory</title>
    <link rel="icon" type="image/x-icon" href="../../../logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        .thead th {
            background-color: burlywood;
        }
    </style>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand " href="../../../../adminhome.php">
                    <img src="../../../logo.png" alt="logo" style="width:70px" class="rounded-pill">
                </a>

                <button type="button" class="btn btn-primary" id="openModalBtn">
                        Add New printer  
                    </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            </div>      
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Printer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../includes/add_printer.php" method="post">
                                <?php foreach ($columns as $column): ?>
                                    <?php if ($column !== 'id' && $column !== 'qr_img' && $column !== 'dept_id'): ?>
                                        <div class="mb-3">
                                            <label for="<?php echo $column; ?>"><?php echo strtoupper(str_replace('_', ' ', $column)); ?>:</label>
                                            <?php if ($column === 'created_at'): ?>
                                                <input type="date" class="form-control" id="<?php echo $column; ?>" name="<?php echo $column; ?>">
                                            <?php else: ?>
                                                <input type="text" class="form-control" id="<?php echo $column; ?>" name="<?php echo $column; ?>">
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <input type="hidden" name="dept_id" value="<?php echo $dept_id; ?>">
                                <button type="submit" class="btn btn-primary mt-3 btn-block">Add</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-info" href="../../../../adminhome.php">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-info" href="../../home.php">Back</a>
                    </li>
                </ul>
            </div>

        </nav>

    </header>

    <script>
        $(document).ready(function() {
            $('#openModalBtn').click(function() {
                $('#myModal').modal('show');
            });
        });
        $(document).ready(function() {
            $('#myModal').on('shown.bs.modal', function () {
                $('#brand').focus();
            });
        });
    </script>

    <div class="container mt-5">
        <h3 class="mt-4 mb-3 text-center text-success">ECE printer Inventory</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead">
                    <tr>
                        <?php
                            // Output column names as table headers
                            foreach ($columns as $column) {
                                echo "<th>$column</th>";
                            }
                            // Add column for Update
                            echo "<th>Update</th>";
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Output the data
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                // Output each value in a row
                                foreach ($row as $key => $value) {
                                    if ($key === 'qr_img') {
                                        echo "<td><img src='../image/$value' alt='QR Code'></td>";
                                    } else {
                                        echo "<td>$value</td>";
                                    }
                                }
                                // Add action buttons for update, delete, and print
                                echo "<td>
                                        <button onclick='updateprinter(" . $row["id"] . ", \"" . implode('","', array_map(function($c) use ($row) { return $row[$c]; }, $columns)) . "\")' class='btn btn-primary'>Update</button>
                                        <br><br>
                                        <a href='../includes/delete_printer.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>
                                        <br><br>
                                        <button onclick='printQR(\"" . $row["qr_img"] . "\")' class='btn btn-success'>Print</button>
                                    </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='" . (count($columns) + 1) . "'>No inventory found</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateLabel">UPDATE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" method="post">
                            <input type="hidden" id="updateId" name="id">
                            <?php foreach ($columns as $column): ?>
                                <?php if ($column !== 'id' && $column !== 'qr_img' && $column !== 'dept_id'): ?>
                                    <div class="mb-3">
                                        <label for="update<?php echo ucfirst($column); ?>"><?php echo strtoupper(str_replace('_', ' ', $column)); ?>:</label>
                                        <input type="text" class="form-control" id="update<?php echo ucfirst($column); ?>" name="<?php echo $column; ?>">
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div id="updateSuccessMessage" class="alert alert-success" style="display: none;">
                                Successfully Updated
                            </div>
                            <button type="submit" class="btn mt-3 btn-primary btn-block">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateprinter(id, ...values) {
            $('#updateId').val(id);
            const columns = <?php echo json_encode($columns); ?>;
            columns.forEach((column, index) => {
                if (column !== 'id' && column !== 'qr_img' && column !== 'dept_id') {
                    $('#update' + column.charAt(0).toUpperCase() + column.slice(1)).val(values[index]);
                }
            });
            $('#updateModal').modal('show');
        }

        $(document).ready(function() {
            $('#updateForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                
                $.ajax({
                    url: '../includes/update_printer.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        $('#updateSuccessMessage').show(); 
                        setTimeout(function() {
                            $('#updateSuccessMessage').hide(); 
                            $('#updateModal').modal('hide'); 
                        }, 5000);
                    },  
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        function printQR(imageSrc) {
            var img = new Image();
            img.src = imageSrc;
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title></head><body><img src="' + imageSrc + '"></body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

    <section class="footer">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </section>
    <section class="footer">
        <?php
            require '../../main/footer.php'
        ?>
    </section>
</body>
</html>
