<?php
session_start();
include('../connection/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $admin_code = isset($_POST["admin_code"]) ? $_POST["admin_code"] : '';

    if ($role === 'admin' && $admin_code !== '2002') {
        $error = "Invalid admin code.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM users_regis WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username already exists. Please choose a different username.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $stmt = $conn->prepare("INSERT INTO users_regis (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                $_SESSION["success"] = "Registration successful. You can now log in.";
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/user_regis.css">
    <script>
        function toggleAdminCode() {
            var role = document.getElementById('role').value;
            var adminCodeField = document.getElementById('admin-code-field');
            adminCodeField.style.display = role === 'admin' ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('register-form').addEventListener('submit', function (event) {
                var role = document.getElementById('role').value;
                if (role === 'admin') {
                    var adminCode = document.getElementById('admin_code').value;
                    if (adminCode !== '2002') {
                        event.preventDefault();
                        alert('Invalid admin code');
                    }
                }
            });
        });
    </script>
</head>
<body>

        <section id="register" class = "py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="card-title text-center">Register</h2>
                                    <?php if (isset($error)): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo $error; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username:</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password:</label>
                                        <input type="password" id="password" name="password" class="form-control"  placeholder="Enter your password..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control"  placeholder="Enter your email..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" class="form-label">Role:</label>
                                        <select id="role" name="role" class="form-select" onchange="toggleAdminCode()" required>
                                            <option value="staff">Staff</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div id="admin-code-field" class="mb-3" style="display:none;">
                                        <label for="admin_code" class="form-label">Admin Code:</label>
                                        <input type="password" id="admin_code" name="admin_code" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </form>
                                <p class="text-center mt-3">Already registered? <a href="login.php">Login here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


  
</body>
</html>
