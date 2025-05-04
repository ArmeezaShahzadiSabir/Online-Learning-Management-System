<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Additional CSS link -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <style>
        body {
            color: black;
            text-decoration: none;
        }

        nav {
            background-color: rgba(255, 255, 255, 0.6);
        }
    </style>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#" style="color: white; text-decoration: none;"><img src="logo.png" alt=""
                width="30"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="" style="color: black; text-decoration: none;"><i class="fas fa-home"></i> Home</a>
                </li>
            </ul>
            <?php
            if (isset($_SESSION["user_role"])) {
                // Get user role from session
                $userRole = $_SESSION["user_role"];
                // Display links based on user role
                echo '<ul class="navbar-nav ml-auto">';
                if ($userRole === "Admin") {
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="display_admin.php" style="color: black; text-decoration: none;"><i class="fas fa-chart-line"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register_user.php" style="color: black; text-decoration: none;"><i class="fas fa-plus"></i> Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_student.php" style="color: black; text-decoration: none;"><i class="fas fa-eye"></i> View Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_employee.php" style="color: black; text-decoration: none;"><i class="fas fa-eye"></i> View Employees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" style="color: black; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>';
                } elseif ($userRole === "Employee") {
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="display_employee.php" style="color: black; text-decoration: none;"><i class="fas fa-chart-line"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_students.php" style="color: black; text-decoration: none;"><i class="fas fa-plus"></i> Add Student</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_student.php" style="color: black; text-decoration: none;"><i class="fas fa-eye"></i> View Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" style="color: black; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>';
                } elseif ($userRole === "Student") {
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_student.php" style="color: black; text-decoration: none;"><i class="fas fa-chart-line"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" style="color: black; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>';
                }
                echo '</ul>';
            } else {
                // If user is not logged in
                echo '
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: black; text-decoration: none;"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php" style="color: black; text-decoration: none;"><i class="fas fa-user-plus"></i> Register</a>
                    </li>
                </ul>';
            }
            ?>
        </div>
    </nav>
    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>