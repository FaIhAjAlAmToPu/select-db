# **Student Lab: View and Filter Students using PHP & SQL**

## **Overview**

This project demonstrates how to:

* Display all student records from a MySQL database
* Filter students by CGPA using a form
* Dynamically generate HTML tables using PHP

The database table `students` has the following columns:

* `id` — student ID (primary key)
* `name` — student name
* `cgpa` — student CGPA

---

## **Why PHP?**

PHP is a server-side scripting language used to create **dynamic web pages**. Unlike plain HTML, PHP can:

* Connect to databases like MySQL
* Fetch, insert, or filter data
* Generate HTML dynamically based on database content

### **Understanding `$` in PHP**

* In PHP, **all variables start with `$`**.
* Examples in this project:

  * `$conn` — stores the **database connection object**
  * `$result` — stores the **result of a database query**
  * `$row` — stores **one row of data** from the query
* `$conn->query("SQL")` — runs an SQL query on the database connection stored in `$conn`
* `$row['id']` — accesses the value of the `id` column in that row

---

## **Database Setup**

```sql
CREATE DATABASE student_lab;

USE student_lab;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll VARCHAR(20) NOT NULL,
    name VARCHAR(50) NOT NULL,
    cgpa DECIMAL(3,2) NOT NULL
);

-- Insert sample data
INSERT INTO students (roll, name, cgpa) VALUES
('18103315', 'Tanmoy Kumar Saha', 3.45),
('20103016', 'M. Sakibul Islam Jibon', 3.80),
('19102220', 'Rahim Uddin', 3.10),
('18104121', 'Fatima Noor', 3.75),
('20103333', 'Arif Hossain', 2.95);
```

---

## **File: index.php** — Show All Students

```php
$conn = new mysqli("localhost", "root", "", "student_lab");
```

* Creates a connection to the MySQL database `student_lab`.
* `"localhost"` = database host, `"root"` = username, `""` = password.

```php
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
```

* Checks if the connection failed and stops the program with an error message.

```php
$result = $conn->query("SELECT * FROM students");
```

* Runs an SQL query to fetch all rows from the `students` table.

```php
$conn->close();
```

* Closes the database connection.

**HTML Section**:

```html
<a href="index.php">View All</a> | <a href="filter.php">Filter by CGPA</a>
```

* Simple navigation links to switch between pages.

```html
<table border="1">
<tr><th>ID</th><th>Name</th><th>CGPA</th></tr>
<?php
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['cgpa']}</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>No students found.</td></tr>";
}
?>
</table>
```

* Creates an HTML table.
* Loops through each student using `while($row = $result->fetch_assoc())`.
* `$row['id']`, `$row['name']`, `$row['cgpa']` are values from the database.

---

## **File: filter.php** — Filter Students by CGPA

```php
$minCgpa = $_POST['minCgpa'] ?? '';
```

* Reads the value entered in the form for **minimum CGPA**.
* If nothing is entered, defaults to an empty string.

```php
$sql = "SELECT * FROM students";
if ($minCgpa !== '') $sql .= " WHERE cgpa >= " . (float)$minCgpa;
$result = $conn->query($sql);
```

* Builds the SQL query dynamically:

  * Adds a `WHERE` clause if a minimum CGPA is provided.
  * Executes the query and stores the results in `$result`.

**HTML Section**:

```html
<form method="POST">
Minimum CGPA: <input type="number" step="0.01" name="minCgpa" value="<?= htmlspecialchars($minCgpa) ?>">
<input type="submit" value="Filter">
</form>
```

* A form for entering the minimum CGPA.
* Submitting reloads the page and filters the students.

```html
<table border="1">
<tr><th>ID</th><th>Name</th><th>CGPA</th></tr>
<?php
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['cgpa']}</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>No students match the filter.</td></tr>";
}
?>
</table>
```

* Displays students that satisfy the CGPA filter.

---

## **How to Run**

1. Start XAMPP (Apache + MySQL).
2. Create the `student_lab` database and `students` table using the SQL above.
3. Place `index.php` and `filter.php` in `htdocs/student_lab/`.
4. Open in browser:

   * `http://localhost/student_lab/index.php` — see all students
   * `http://localhost/student_lab/filter.php` — filter by CGPA

---