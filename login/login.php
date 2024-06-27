<?php
 include('../connection/connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM users_regis WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["username"] = $row["username"];
                $_SESSION["role"] = $row["role"];
                if ($row["role"] == "admin") {
                    header("Location: ../adminhome.php");
                } elseif ($row["role"] == "staff") {
                    header("Location: ../userhome.php");
                }
                exit();
            } else {
                $error = "Invalid username or password";
            }
        } else {
            $error = "Username and password are required";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    <link rel="stylesheet" type="text/css" href="../css/user_login.css">
</head>
<body>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-title text-center">Login</h5>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username..." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password..." required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <p class="text-center mt-3">Not registered? <a href="user_regis.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
