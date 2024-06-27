<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["success"])) {
    $success_message = $_SESSION["success"];
    unset($_SESSION["success"]);
} else {
    header("Location: display_computer.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success">
        <?php echo htmlspecialchars($success_message); ?>
    </div>
    <a href="display_computer.php" class="btn btn-primary">Back to Device Details</a>
</div>
</body>
</html>
