# 🧾 SQL Quick Cheat Sheet

### 🗂️ Database Setup

Create new database →

```sql
CREATE DATABASE db_name;
```

Show all databases →

```sql
SHOW DATABASES;
```

Select a database to use →

```sql
USE db_name;
```

---

### 📋 Table Creation

Create a table →

```sql
CREATE TABLE table_name (col_name DATATYPE CONSTRAINT, ...);
```

### 🔑 Keys & Constraints

Set Primary Key →

```sql
PRIMARY KEY (col_name);
```

Add Foreign Key →

```sql
FOREIGN KEY (col_name) REFERENCES other_table(col_name);
```

Make column not empty →

```sql
col_name DATATYPE NOT NULL;
```

Limit value range →

```sql
CHECK (condition);
```

---

#### 📋 **Example Scenario: Online Store**

**Tables needed:** `customers` and `orders`

---

##### 1️⃣ Customers Table

```sql
CREATE TABLE customers (
    customer_id INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone CHAR(11)
);
```

* Stores customer information
* Primary key ensures unique customers
* Email must be unique

---

##### 2️⃣ Orders Table

```sql
CREATE TABLE orders (
    order_id INT PRIMARY KEY,
    customer_id INT,
    product_name VARCHAR(100) NOT NULL,
    quantity INT CHECK (quantity > 0),
    order_date DATE NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);
```

* Tracks orders made by customers
* Foreign key links each order to a customer
* Quantity cannot be zero or negative

---


#### Show table structure →

```sql
DESCRIBE table_name;
```

---



### ⚙️ Table Management

Show all tables →

```sql
SHOW TABLES;
```

Rename a table →

```sql
RENAME TABLE old_name TO new_name;
```

Delete a table →

```sql
DROP TABLE table_name;
```

---

### 🧱 Data Insertion

Insert full row →

```sql
INSERT INTO table_name VALUES (val1, val2, ...);
```

Insert specific columns →

```sql
INSERT INTO table_name (col1, col2) VALUES (val1, val2);
```

---

### 🔍 Viewing Data

Show all data →

```sql
SELECT * FROM table_name;
```

Show selected columns →

```sql
SELECT col1, col2 FROM table_name;
```

---