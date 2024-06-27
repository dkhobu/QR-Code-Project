<?php
    session_start();
    include('../../../connection/connect.php');
    $sql = "SELECT * FROM aetprinters";
    $result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Inventory</title>
    <link rel="icon" type="image/x-icon" href="../../../logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../../../../userhome.php">
                    <img src="../../../logo.png" alt="logo" style="width:70px" class="rounded-pill">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-info" href="../../../../userhome.php">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-info" href="../../userhome.php">Back</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h3 class="mt-4 mb-3 text-center text-success">AET Printer Inventory</h3>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th>ID</th>                    
                        <th>DEPT ID</th>
                        <th>BRAND</th>
                        <th>MODEL</th>
                        <th>PR NUMBER</th>
                        <th>COLOR</th>
                        <th>TYPE</th>
                        <th>RESOLUTION</th>
                        <th>PROBLEM</th>
                        <th>QR IMG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["dept_id"] . "</td>";
                            echo "<td>" . $row["brand"] . "</td>";
                            echo "<td>" . $row["model"] . "</td>";
                            echo "<td>" . $row["pr_number"] . "</td>";
                            echo "<td>" . $row["color"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>" . $row["resolution"] . "</td>";
                            echo "<td id='problem-" . $row["id"] . "'>" . $row["problem"] . "</td>";
                            echo "<td><img src='" . $row["qr_img"] . "' alt='QR Code' style='width:120px;height:120px;'></td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No inventory found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        require '../../main/footer.php'
    ?>
</body>
</html>

