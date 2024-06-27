<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h3 class="text-center">Error</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION["error_message"])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION["error_message"]; ?></div>
                        <?php unset($_SESSION["error_message"]); ?>
                    <?php else: ?>
                        <div class="alert alert-danger">An unexpected error occurred.</div>
                    <?php endif; ?>
                    <p class="text-center"><a href="login.php">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
