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
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $adminName = $row["username"];
        $email = $row["email"];
        $userRole = $row["user_role"];
    } else {
        echo "Admin record not found.";
        exit;
    }
    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminNameNew = $_POST["adminName"];
    $emailNew = $_POST["email"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE users SET username = '$adminNameNew', email = '$emailNew' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: display_admin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}
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
        <h2>Edit Admin Details</h2>
        <form action="edit_admin.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group">
                <label for="adminName">Admin Name:</label>
                <input type="text" class="form-control" id="adminName" name="adminName"
                    value="<?php echo $adminName; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Details</button>
        </form>
    </div>
    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>