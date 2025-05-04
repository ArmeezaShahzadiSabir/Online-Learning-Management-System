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

$sql = "SELECT id, username, email FROM users WHERE user_role = 'Admin'"; // Filter by user_role
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Additional CSS link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3">
        <h2>Administrator List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Admin Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>Admin</td>";
                        // echo "<td>
                        //     <a href='edit_admin.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>
                        //     <a href='delete_admin.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                        // </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No administrators found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
