<?php
    require 'main/userheader.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER VIEW</title>
    <link rel="icon" type="image/x-icon" href="../logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
        .card {
            flex: 1; 
            margin: 0 10px;
        }
        .card-img-top:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">All BT Items</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3" style="width:300px">
                    <img src="../../image/computer1.jpeg" class="card-img-top" alt="Computer Image">
                    <div class="card-body">
                        <h5 class="card-title">COMPUTER'S</h5>
                        <p class="card-text">View BT computers.</p>
                        <a href="computer/pages/userview.php" class="btn btn-primary">View Computer's</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="width:300px;">
                    <img src="../../image/laptop.jpeg" style="height: 225px;" class="card-img-top" alt="Laptop Image">
                    <div class="card-body">
                        <h5 class="card-title">LAPTOP'S</h5>
                        <p class="card-text">View BT laptops.</p>
                        <a href="laptop/pages/userview.php" class="btn btn-primary">View Laptop's</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="width:300px">
                    <img src="../../image/printer1.jpg" style="height: 230px;" class="card-img-top" alt="Printer Image">
                    <div class="card-body">
                        <h5 class="card-title">PRINTER'S</h5>
                        <p class="card-text">View BT printers.</p>
                        <a href="printer/pages/userview.php" class="btn btn-primary">View Printer's</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    <?php
        require 'main/footer.php'
    ?>
</body>
</html>
