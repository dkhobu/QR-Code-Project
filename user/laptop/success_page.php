<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if (isset($_SESSION["success_message"])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_SESSION["success_message"]); ?>
            </div>
        <?php endif; ?>
        <button type="button" class="btn btn-primary" onclick="window.location.href='login.php'">Back</button>
    </div>
</body>
</html>

<?php
unset($_SESSION["success_message"]); // Clear success message after displaying
?>
