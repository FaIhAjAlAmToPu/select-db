<?php
$conn = new mysqli("localhost", "root", "", "student_lab");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$minCgpa = $_POST['minCgpa'] ?? '';
$sql = "SELECT * FROM students";
if ($minCgpa !== '') $sql .= " WHERE cgpa >= " . (float)$minCgpa;

$result = $conn->query($sql);
$conn->close();
?>

<html>
<head><title>Filter Students</title></head>
<body>
<h1>Filter Students by CGPA</h1>
<a href="index.php">View All</a> | <a href="filter.php">Filter by CGPA</a>

<form method="POST">
Minimum CGPA: <input type="number" step="0.01" name="minCgpa" value="<?= htmlspecialchars($minCgpa) ?>">
<input type="submit" value="Filter">
</form>

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
    echo "<tr><td colspan='3'>No students match the filter.</td></tr>";
}
?>
</table>
</body>
</html>
