<?php
    require 'main/header.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
        .card {
            flex: 1;
            margin: 0 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover effect */
        }
        .card:hover {
            transform: scale(1.05); /* Slightly scale up the card on hover */
            box-shadow: 0 8px 16px rgba(0,0,0,0.3); /* Add a shadow on hover */
        }
        .card-img-top {
            transition: transform 0.3s ease;
        }
        .card:hover .card-img-top {
            transform: scale(1.1); /* Slightly scale up the image on card hover */
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        @media (max-width: 767.98px) {
            .about-image {
                flex: 0 0 100%;
                max-width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">All ECE Items</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3" style="width:300px">
                    <img src="../../image/computer1.jpeg" class="card-img-top" alt="Computer Image">
                    <div class="card-body">
                        <h5 class="card-title">COMPUTER'S</h5>
                        <p class="card-text">View Ece computers.</p>
                        <a href="computer/pages/adminview.php" class="btn btn-primary">View Computer's</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="width:300px;">
                    <img src="../../image/laptop.jpeg" style="height: 225px;" class="card-img-top" alt="Laptop Image">
                    <div class="card-body">
                        <h5 class="card-title">LAPTOP'S</h5>
                        <p class="card-text">View Ece laptops.</p>
                        <a href="laptop/pages/adminview.php" class="btn btn-primary">View Laptop's</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3" style="width:300px">
                    <img src="../../image/printer1.jpg" style="height: 230px;" class="card-img-top" alt="Printer Image">
                    <div class="card-body">
                        <h5 class="card-title">PRINTER'S</h5>
                        <p class="card-text">View Ece printers.</p>
                        <a href="printer/pages/adminview.php" class="btn btn-primary">View Printer's</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        require 'main/footer.php'
    ?>

</body>
</html>

