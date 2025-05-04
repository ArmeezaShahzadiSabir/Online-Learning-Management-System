<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Employee") {
    header("Location: index.php");
    exit();
}
$id=$_SESSION["admin_id"];
$conn = new mysqli("localhost", "root", "", "students");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM users WHERE id=$id";
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
        <h4><b>Employee Records</b></h4>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                    <?php
                        echo "<a href='edit_employee.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm mr-2'>Update</a>";
                        echo "<a href='delete_employee.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>";
                    ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
