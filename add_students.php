<?php
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST["student_name"];
    $rollNo = $_POST["roll_no"];
    $department = $_POST["department"];
    $marks = $_POST["marks"];
    $email = $_POST["email"];
    $reg_by = $_SESSION["admin_name"];
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO  student_info (student_name, roll_no, department, marks, email, reg_by) 
            VALUES ('$studentName', '$rollNo', '$department', '$marks', '$email', '0')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard_student.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add New Student</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include 'navbar.php'; ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container mt-3" style="width: max-content;">
        <h2>Add Your Student Record</h2>
        <form action="add_students.php" method="post">
            <div class="form-group">
                <label for="student_name">Full Name:</label>
                <input type="text" class="form-control" id="studen_name" name="student_name"
                    placeholder="Enter full name" required>
            </div>
            <div class="form-group">
                <label for="roll_no">Roll Number:</label>
                <input type="text" class="form-control" id="roll_no" name="roll_no" placeholder="Enter roll number"
                    required>
            </div>
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" class="form-control" id="department" name="department" placeholder="Enter department"
                    required>
            </div>
            <div class="form-group">
                <label for="marks">Marks:</label>
                <input type="text" class="form-control" id="marks" name="marks" placeholder="Enter marks" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>
</body>

</html>