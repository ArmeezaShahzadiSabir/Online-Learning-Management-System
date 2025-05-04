<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Admin") {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "students");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM student_info";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    header("Location: display_student.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $deleteSql = "DELETE FROM student_info WHERE id = $id";
    if ($conn->query($deleteSql) === TRUE) {
        header("Location: display_student.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Invalid request.";
    exit();
}
$conn->close();
?>