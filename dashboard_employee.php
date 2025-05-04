<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Employee") {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "students");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

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
    <?php include 'navbar.php'; ?>
    <div class="container mt-3">
        <h2><b>Employee Dashboard</b></h2>
        <?php 
            echo "<h3>Welcome <b>" . $_SESSION["admin_name"] . "!</b></h3>";
            echo "<p><b>ID:</b> " . $_SESSION["admin_id"] . "</p>";
            echo "<p><b>Email:</b> " . $_SESSION["admin_email"] . "</p>";
        ?>
    </div>
    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
