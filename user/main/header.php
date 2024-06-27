<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header</title>
    <link rel="icon" type="image/x-icon" href="../../image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="../../adminhome.php">
                    <img src="../../image/logo.png" alt="logo" style="width:70px" class="rounded-pill">
                </a>         
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../AdminPanel.php">Admin</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Department
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="../../admin/aetdept/home.php">AGRI Department</a></li>
                                <li><a class="dropdown-item" href="../../admin/btdept/home.php">BIOTECH Department</a></li>
                                <li><a class="dropdown-item" href="../../admin/csedept/home.php">CSE Department</a></li>
                                <li><a class="dropdown-item" href="../../admin/ecedept/home.php">ECE Department</a></li>
                                <li><a class="dropdown-item" href="../../admin/itdept/home.php">IT Department</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReports" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                View Reports
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownReports">
                                <li><a class="dropdown-item" href="../computer/view_reports.php?type=computer">Computer</a></li>
                                <li><a class="dropdown-item" href="../laptop/view_reports.php?type=laptop">Laptop</a></li>
                                <li><a class="dropdown-item" href="../printer/view_reports.php?type=printer">Printer</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login/login.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
