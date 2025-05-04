<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $userRole = $_POST["user_role"];
    $password = $_POST["password"];
    // $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $regBy = ''; // Initialize the reg_by value
    if ($userRole === "Employee" || $userRole === "Admin") {
        $regBy = $_SESSION["admin_name"]; // Set reg_by for Employee or Admin
    }
    
    $conn = mysqli_connect("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO users (username, email, user_role, password) VALUES ('$name', '$email', '$userRole', '$password')";
    if ($conn->query($sql) === TRUE) {
        $lastInsertId = $conn->insert_id;
        $data = $conn->query("SELECT * FROM users WHERE id = $lastInsertId")->fetch_assoc();
        if (isset($data)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["adminloggedin"] = true;
            $_SESSION["admin_id"] = $data['id'];
            $_SESSION["admin_name"] = $data['username'];
            $_SESSION["admin_email"] = $data['email'];
            $_SESSION["user_role"] = $data['user_role'];
            
            // Insert student info into student_info table with reg_by
            $insertSql = "INSERT INTO student_info (student_name, email, reg_by) VALUES ('$name', '$email', '$regBy')";
            $conn->query($insertSql);
            
            if ($userRole === "Student") {
                header("Location: add_students.php");
                exit();
            } elseif ($userRole === "Employee") {
                header("Location: display_employee.php");
                exit();
            } elseif ($userRole === "Admin") {
                header("Location: display_admin.php");
                exit();
            }
            exit();
        } else {
            echo "Error: Unable to fetch user data from the database.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST["name"];
//     $email = $_POST["email"];
//     $userRole = $_POST["user_role"];
//     $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
//     $conn = mysqli_connect("localhost", "root", "", "students");
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     $sql = "INSERT INTO users (username, email, user_role, password) VALUES ('$name', '$email', '$userRole', '$hashedPassword')";
//     if ($conn->query($sql) === TRUE) {
//         $lastInsertId = $conn->insert_id;
//         $data = $conn->query("SELECT * FROM users WHERE id = $lastInsertId")->fetch_assoc();
//         if (isset($data)) {
//             $_SESSION["loggedin"] = true;
//             $_SESSION["adminloggedin"] = true;
//             $_SESSION["admin_id"] = $data['id'];
//             $_SESSION["admin_name"] = $data['username'];
//             $_SESSION["admin_email"] = $data['email'];
//             $_SESSION["user_role"] = $data['user_role'];
//             if ($userRole === "Student") {
//                 header("Location: add_students.php");
//             } elseif ($userRole === "Employee") {
//                 header("Location: dashboard_employee.php");
//             } elseif ($userRole === "Admin") {
//                 header("Location: dashboard_admin.php");
//             }
//             exit();
//         } else {
//             echo "Error: Unable to fetch user data from the database.";
//         }
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
//     $conn->close();
// }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3" style="width: max-content;">
        <h1 class="mb-4">User Registration</h1>
        <?php
        if (!empty($errors)) {
            echo "<div class='alert alert-danger'>";
            foreach ($errors as $error) {
                echo "<p class='mb-0'>$error</p>";
            }
            echo "</div>";
        } ?>
        <form method="POST" action="register_user.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="user_role">User Role:</label>
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
                style="background-color: #008BA1; width: 100%; font-weight: bold;">Register</button>
            <br>
            <div style="text-align: center;">
                <small>Already have an account </small><a href="index.php" style="text-decoration: underline;">Login</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>