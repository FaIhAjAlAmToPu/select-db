# 🌱 **PHP TUTORIAL (BEGINNER LEVEL + EASY EXPLANATION)**

---

# ⭐ **PART 1 — What is PHP?**

PHP = a programming language that runs on the server.

* HTML = only displays pages
* PHP = does logic (calculations, saving data, login, connecting databases)

To run PHP, you must use **XAMPP** because PHP needs a server to run.

---

# ⭐ **PART 2 — Setup**

1. Install **XAMPP**
2. Start **Apache**
3. Start **MySQL**
4. Create a folder inside:

```
C:\xampp\htdocs\<projectName>\
```

5. Create a file inside it:

`test.php`

6. Write:

```php
<?php
echo "Hello PHP!";
?>
```

Open in browser:

```
http://localhost/phpclass/test.php
```

You will see: **Hello PHP!**

---

# ⭐ **PART 3 — PHP BASICS**

---

## ✔ 3.1 Variables

Used to store values.

```php
<?php
$name = "Topu";
$age = 20;

echo $name;    // Output: Topu
echo $age;     // Output: 20
?>
```

---

## ✔ 3.2 Operators

### Arithmetic

```php
<?php
$a = 10;
$b = 5;

echo $a + $b;  // 15
echo $a - $b;  // 5
echo $a * $b;  // 50
echo $a / $b;  // 2
?>
```

---

## ✔ 3.3 If–Else

```php
<?php
$age = 17;

if($age >= 18){
    echo "Adult";
} else {
    echo "Child";
}
?>
```

---

## ✔ 3.4 Loops

### For loop

```php
<?php
for($i = 1; $i <= 5; $i++){
    echo $i . "<br>";
}
?>
```

### While loop

```php
<?php
$x = 1;
while($x <= 3){
    echo $x . "<br>";
    $x++;
}
?>
```

---

## ✔ 3.5 Arrays

```php
<?php
$fruits = ["Mango", "Banana", "Apple"];

echo $fruits[0];   // Mango
?>
```

### Foreach

```php
<?php
foreach($fruits as $f){
    echo $f . "<br>";
}
?>
```

---

## ✔ 3.6 Functions

```php
<?php
function square($n){
    return $n * $n;
}

echo square(4);   // 16
?>
```

---

# 🎯 **ANSWERS to BASIC EXERCISES**

---

## **Q1. Print your name 10 times**

```php
<?php
for($i=1; $i<=10; $i++){
    echo "My name is Topu <br>";
}
?>
```

---

## **Q2. Create an array of 5 fruits & display them**

```php
<?php
$fruits = ["Mango", "Orange", "Apple", "Grape", "Banana"];

foreach($fruits as $f){
    echo $f . "<br>";
}
?>
```

---

## **Q3. Make a small calculator**

```php
<?php
$a = 6;
$b = 3;

echo "Add: " . ($a + $b) . "<br>";
echo "Sub: " . ($a - $b) . "<br>";
echo "Mul: " . ($a * $b) . "<br>";
echo "Div: " . ($a / $b) . "<br>";
?>
```

---

## **Q4. Function to return square of a number**

```php
<?php
function square($num){
    return $num * $num;
}

echo square(5);    // 25
?>
```

---

# ⭐ **PART 4 — PHP + HTML Forms**

---

## ✔ Example: GET Form

### HTML:

```html
<form method="GET">
    <input type="text" name="username">
    <button>Submit</button>
</form>
```

### PHP:

```php
<?php
echo "Hello " . $_GET["username"];
?>
```

---

## ✔ Example: POST Form

### HTML:

```html
<form method="POST">
    <input type="text" name="email">
    <button>Send</button>
</form>
```

### PHP:

```php
<?php
echo "Your email: " . $_POST["email"];
?>
```

---

# ⭐ **PART 5 — PHP + MySQL (XAMPP)**

---

# ✔ Step 1: Create database

Go to **phpMyAdmin**
Create DB: `school`

Create table:

```sql
CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100)
);
```

---

# ✔ Step 2: Connect PHP to DB (connection file)

Create **db.php**:

```php
<?php
$conn = new mysqli("localhost", "root", "", "school");

if($conn->connect_error){
    die("Connection failed");
}
?>
```

---

# ⭐ **PART 6 — CRUD**

---

# ✔ A. INSERT (Add student)

### HTML Form:

```html
<form method="POST" action="add.php">
    <input type="text" name="name" placeholder="Enter name">
    <button>Add</button>
</form>
```

### add.php:

```php
<?php
include "db.php";

$name = $_POST["name"];

$sql = "INSERT INTO students(name) VALUES('$name')";
$conn->query($sql);

echo "Student Added!";
?>
```

---

# ✔ B. SELECT (Show all students)

```php
<?php
include "db.php";

$result = $conn->query("SELECT * FROM students");
?>

<table border="1">
<tr>
  <th>ID</th>
  <th>Name</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>
<tr>
  <td><?php echo $row["id"]; ?></td>
  <td><?php echo $row["name"]; ?></td>
</tr>
<?php } ?>

</table>
```

---

# ✔ C. DELETE Student

`delete.php?id=3`

```php
<?php
include "db.php";

$id = $_GET["id"];

$conn->query("DELETE FROM students WHERE id=$id");

echo "Deleted!";
?>
```

---

# ✔ D. UPDATE Student

### edit.php:

```php
<?php
include "db.php";

$id = $_GET["id"];
$row = $conn->query("SELECT * FROM students WHERE id=$id")->fetch_assoc();
?>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="text" name="name" value="<?php echo $row['name']; ?>">
    <button>Update</button>
</form>
```

### update.php:

```php
<?php
include "db.php";

$id = $_POST["id"];
$name = $_POST["name"];

$conn->query("UPDATE students SET name='$name' WHERE id=$id");

echo "Updated!";
?>
```

---