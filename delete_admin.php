<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Admin") {
    header("Location: index.php");
    exit();
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: display_admin.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
?>