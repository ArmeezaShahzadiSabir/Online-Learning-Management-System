<?php
session_start();
if (isset($_SESSION["admin_id"])) {
    ?>
    <!-- <script>
        window.location.replace("dashboard_admin.php");
    </script> -->
    <?php
    header("Location: dashboard_admin.php");
    exit();
}
$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $userRole = $_POST["user_role"];
    $password = $_POST["password"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT id, username, email, user_role, password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        if (password_verify($password, $hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["adminloggedin"] = true;
            $_SESSION["admin_id"] = $row["id"];
            $_SESSION["admin_name"] = $row["username"];
            $_SESSION["admin_email"] = $row["email"];
            $_SESSION["user_role"] = $row["user_role"];
            if ($row["user_role"] === "Student") {
                ?>
                <script>
                    window.location.replace("add_students.php");
                </script>
                <?php
            } elseif ($row["user_role"] === "Employee") {
                ?>
                <script>
                    window.location.replace("dashboard_employee.php");
                </script>
                <?php
            } elseif ($row["user_role"] === "Admin") {
                ?>
                <script>
                    window.location.replace("dashboard_admin.php");
                </script>
                <?php
            }
        } else {
            $errors[] = "Invalid email or password";
        }
    } else {
        $errors[] = "Invalid email or password";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3" style="width: max-content;">
        <h1 class="mb-4" style="text-decoration: underline;">User Login Form</h1>
        <?php
        if (!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo "<p class='mb-0'>$error</p>";
            }
            echo "</div>";
        } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="user_role">Select User Role:</label>
                <select class="form-control" name="user_role" required>
                    <option value="Student">Student</option>
                    <option value="Employee">Employee</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <button type="submit" class="btn btn-primary"
                style="width: 100%; background-color: #008BA1; font-weight: bold;">Login</button>
            <br>
            <div style="text-align: center;">
                <small>Already have an account </small><a href="register_user.php"
                    style="text-decoration: underline;">Register</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>