<?php
    include('../connection/connect.php');

    $computer_query = "SELECT * FROM biotechcomputers";
    $computer_result = $conn->query($computer_query);

    $laptop_query = "SELECT * FROM btlaptops";
    $laptop_result = $conn->query($laptop_query);

    $printer_query = "SELECT * FROM btprinters";
    $printer_result = $conn->query($printer_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-link:hover {
            color: red; 
            text-decoration: underline; 
        }
    </style>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../logo.png" alt="logo" style="width:70px" class="rounded-pill">
                </a>

            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="../../userhome.php"style="font-size: 20px;color: blue;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-size: 20px;color: blue" href="userhome.php">Back</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    <h2 class="text-center text-success">All BIOTECH ITEM'S</h2>
    <div class="container mt-3">
        <h3 class="text-center">Computer's</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>PC Number</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>Storage</th>
                        <th>Problem</th>
                        <th>Created At</th>
                        <th>QR img</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($computer_row = $computer_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $computer_row['id']; ?></td>
                            <td><?php echo $computer_row['brand']; ?></td>
                            <td><?php echo $computer_row['model']; ?></td>
                            <td><?php echo $computer_row['pc_number']; ?></td>
                            <td><?php echo $computer_row['processor']; ?></td>
                            <td><?php echo $computer_row['ram']; ?></td>
                            <td><?php echo $computer_row['storage']; ?></td>
                            <td><?php echo $computer_row['problem']; ?></td>
                            <td><?php echo $computer_row['created_at']; ?></td>
                            <td><?php echo $computer_row['qr_img']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-5">
        <h3 class="text-center">Laptop's</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Lap Number</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>Storage</th>
                        <th>Problem</th>
                        <th>Created At</th>
                        <th>QR img</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($laptop_row = $laptop_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $laptop_row['id']; ?></td>
                            <td><?php echo $laptop_row['brand']; ?></td>
                            <td><?php echo $laptop_row['model']; ?></td>
                            <td><?php echo $laptop_row['lap_number']; ?></td>
                            <td><?php echo $laptop_row['processor']; ?></td>
                            <td><?php echo $laptop_row['ram']; ?></td>
                            <td><?php echo $laptop_row['storage']; ?></td>
                            <td><?php echo $laptop_row['problem']; ?></td>
                            <td><?php echo $laptop_row['created_at']; ?></td>
                            <td><?php echo $laptop_row['qr_img']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-5">
        <h3 class="text-center">Printer's</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Pr Number</th>
                        <th>Color</th>
                        <th>Type</th>
                        <th>Resolution</th>
                        <th>Problem</th>
                        <th>Created At</th>
                        <th>Qr img</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($printer_row = $printer_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $printer_row['id']; ?></td>
                            <td><?php echo $printer_row['brand']; ?></td>
                            <td><?php echo $printer_row['model']; ?></td>
                            <td><?php echo $printer_row['pr_number']; ?></td>
                            <td><?php echo $printer_row['color']; ?></td>
                            <td><?php echo $printer_row['type']; ?></td>
                            <td><?php echo $printer_row['resolution']; ?></td>
                            <td><?php echo $printer_row['problem']; ?></td>
                            <td><?php echo $printer_row['created_at']; ?></td>
                            <td><?php echo $printer_row['qr_img']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
