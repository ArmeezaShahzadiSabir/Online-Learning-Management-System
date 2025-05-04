<?php
$conn = new mysqli("localhost", "root", "", "students");
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Admin") {
    header("Location: index.php");
    ?>
    <!-- <script>
        window.location.replace("index.php");
    </script> -->
    <?php
    exit();
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3">
        <h1 class="mb-4">Admin Dashboard</h1>
        <?php
        echo "<p>Welcome, <b>" . $_SESSION["admin_name"] . "</b></p>";
        echo "<p><b>ID:</b> " . $_SESSION["admin_id"] . "</p>";
        echo "<p><b>Email:</b> " . $_SESSION["admin_email"] . "</p>";
        // if (isset($_SESSION["admin_email"])) {
        //     echo "<p>Email: " . $_SESSION["admin_email"] . "</p>";
        // } else {
        //     echo "<p>Email not available</p>";
        // }        
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>