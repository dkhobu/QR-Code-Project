<?php
session_start();
include('../connection/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $sql = "SELECT * FROM users_regis WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $error = "Username already exists. Please choose a different username.";
    } else {
        $sql = "INSERT INTO users_regis (username,email, password, role) VALUES ('$username','$email', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION["success"] = "Registration successful. You can now login.";
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="../../image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/user_regis.css">
    <style>
    

    
    
    
    <style>
</head>
<body>
    
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-title text-center">Registration Form</h5>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username..." required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email..." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password..." required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select class="form-control" id="role" name="role">
                                    <option  value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </form>
                        <p class="text-center mt-3">Already registered? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
