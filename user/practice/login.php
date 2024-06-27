<?php
session_start();
include('../connection/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $pc_number = $_POST["pc_number"] ?? '';
    $dept_id = $_POST["dept_id"] ?? '';

    // Prepared statement to prevent SQL injection
    $query = "SELECT * FROM users_regis WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION["username"] = $username;
            // Redirect to display_computer with pc_number and dept_id if logged in
            $url = "display_computer.php?pc_number=" . urlencode($pc_number) . "&dept_id=" . urlencode($dept_id);
            header("Location: $url");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" name="pc_number" value="<?php echo htmlspecialchars($_GET['pc_number'] ?? ''); ?>">
                        <input type="hidden" name="dept_id" value="<?php echo htmlspecialchars($_GET['dept_id'] ?? ''); ?>">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
