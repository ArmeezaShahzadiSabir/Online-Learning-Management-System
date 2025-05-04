<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Student") {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM student_info WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $studentName = $row["student_name"];
        $rollNo = $row["roll_no"];
        $department = $row["department"];
        $marks = $row["marks"];
        $email = $row["email"];
    } else {
        echo "Student record not found.";
        exit;
    }
    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $studentNameNew = $_POST["studentName"];
    $rollNoNew = $_POST["rollNo"];
    $departmentNew = $_POST["department"];
    $marksNew = $_POST["marks"];
    $emailNew = $_POST["email"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE student_info SET student_name = '$studentNameNew', roll_no = '$rollNoNew', department = '$departmentNew', marks = '$marksNew', email = '$emailNew' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: display_student.php");
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
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Additional CSS link -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-3">
        <h2>Update Student Record</h2>
        <form action="edit_student.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="studentName">Student Name:</label>
                <input type="text" class="form-control" id="studentName" name="studentName"
                    value="<?php echo $studentName; ?>" required>
            </div>
            <div class="form-group">
                <label for="rollNo">Roll Number:</label>
                <input type="text" class="form-control" id="rollNo" name="rollNo" value="<?php echo $rollNo; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department"
                    value="<?php echo $department; ?>" required>
            </div>
            <div class="form-group">
                <label for="marks">Marks:</label>
                <input type="text" class="form-control" id="marks" name="marks" value="<?php echo $marks; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Record</button>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>