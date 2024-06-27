<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .nav-link {
            color: lightblue !important; /* Use a light blue color */
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .nav-link:hover {
            background-color: #17a2b8 !important; /* Use Bootstrap's info color for hover background */
            color: #fff !important; /* White text on hover */
        }
        .btn-outline-info {
            border-color: #17a2b8 !important; /* Use Bootstrap's info color for border */
        }
    </style>
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../../../adminhome.php">
                    <img src="../logo.png" alt="logo" style="width:70px" class="rounded-pill">
                </a>                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-info me-2" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-info me-2" href="viewall.php">ViewAll</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-info" href="../../adminhome.php">Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</body>
</html>
