<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Student") {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "students");
$sql = "SELECT * FROM student_info";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Display Students</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3" style="width: max-content;">
        <h2>Student Records</h2>
        <table class="table">
            <tr>
                <th>Student Name</th>
                <th>Roll Number</th>
                <th>Department</th>
                <th>Marks</th>
                <th>Email</th>
                <th>Admin Name</th>
                <!-- <th>Admin ID</th> -->
                <th style="text-align: center;">Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php echo $row["student_name"]; ?>
                    </td>
                    <td>
                        <?php echo $row["roll_no"]; ?>
                    </td>
                    <td>
                        <?php echo $row["department"]; ?>
                    </td>
                    <td>
                        <?php echo $row["marks"]; ?>
                    </td>
                    <td>
                        <?php echo $row["email"]; ?>
                    </td>
                    <td>
                        <?php echo $row["reg_by"]; ?>
                    </td>
                    <!-- <td>
                        <?php //echo $row["admin_id"]; ?>
                    </td> -->
                    <?php
                    echo "<td>";
                    echo "<a href='edit_student.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm mr-2'>Update</a>";
                    echo "<a href='delete_student.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>";
                    echo "</td>";
                    ?>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <!-- Bootstrap JS and jQuery scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>