<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Admin") {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard_employee.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
}
?>

<!-- <!DOCTYPE html>
<html>

<head>
    <title>Delete Employee Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php //include 'navbar.php'; ?>
    <div class="container mt-3">
        <h2>Delete Employee Record</h2>
        <p>Are you sure you want to delete this employee record?</p>
        <?php
        // if (isset($_GET["id"])) {
        //     echo '<a href="delete_employee.php?id=' . $_GET["id"] . '&confirm=true" class="btn btn-danger">Yes, Delete</a>';
        //     echo ' <a href="display_employee.php" class="btn btn-secondary">Cancel</a>';
        // } else {
        //     echo "Invalid request.";
        // }
        ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html> -->