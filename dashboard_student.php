<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["user_role"] !== "Admin") {
    header("Location: index.php");
    exit();
}
$studentId = $_SESSION["admin_id"];
$conn = new mysqli("localhost", "root", "", "students");
$sql = "SELECT * FROM student_info WHERE id=$studentId";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3">
        <h3><b>Student Dashboard</b></h3>
        <?php
        echo "<p>Welcome, <b><u>" . $_SESSION["admin_name"] . "</u></b></p>";
        echo "<p><b>ID:</b> " . $_SESSION["admin_id"] . "</p>";
        echo "<p><b>Email:</b> " . $_SESSION["admin_email"] . "</p>";
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll No</th>
                        <th>Department</th>
                        <th>Marks</th>
                        <th>Email</th>
                        <th>Reg By</th>
                        <th>Actions</th>
                    </tr>
                </thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo 
                    "<td>" . $row["student_name"] . "</td>
                    <td>" . $row["roll_no"] . "</td>
                    <td>" . $row["department"] . "</td>
                    <td>" . $row["marks"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["reg_by"] . "</td>";
                echo "<td>";
                echo "<a href='edit_student.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Update</a>";
                echo "<a href='delete_student.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm ml-2'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "No data available.";
        }
        ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>