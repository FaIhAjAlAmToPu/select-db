<?php
$conn = new mysqli("localhost", "root", "", "student_lab");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM students");
$conn->close();
?>

<html>
<head><title>All Students</title></head>
<body>
<h1>All Students</h1>
<a href="index.php">View All</a> | <a href="filter.php">Filter by CGPA</a>

<table border="1">
<tr><th>ID</th><th>Name</th><th>CGPA</th></tr>
<?php
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['cgpa']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No students found.</td></tr>";
}
?>
</table>
</body>
</html>
