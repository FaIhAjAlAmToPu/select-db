### Display All Data

```sql
SELECT * FROM table_name;
```

### Select Specific Columns

```sql
SELECT column1, column2 FROM table_name;
```

### Rename a Column Heading (Alias)

```sql
SELECT column_name AS new_heading FROM table_name;
```

### Use a Table Alias

```sql
FROM table_name AS alias_name;
```

### Use a Computed Column

```sql
SELECT (column + 10) AS new_column
FROM table_name;
```
---

### Limit the Number of Rows

```sql
SELECT * FROM table_name LIMIT 5;          -- MySQL / MariaDB
SELECT TOP 5 * FROM table_name;            -- SQL Server
```

### LIMIT + OFFSET Together**

You can combine both to control **which part of the result** you see.

```sql
-- Show 5 records starting from the 11th row
SELECT * FROM Students LIMIT 5 OFFSET 10;
```

Here,

* `OFFSET 10` skips the first 10 rows
* `LIMIT 5` then displays the next 5 rows

---

### String and Formatting Functions

| Task                 | Function Example                        |
| -------------------- | --------------------------------------- |
| Uppercase text       | `UPPER(column_name)`                    |
| Lowercase text       | `LOWER(column_name)`                    |
| String length        | `LENGTH(column_name)`                   |
| First few characters | `SUBSTRING(column_name, start, length)` |
| Last few characters  | `RIGHT(column_name, n)`                 |
| Reverse text         | `REVERSE(column_name)`                  |
| Combine text         | `CONCAT(column1, ' ', column2)`         |

---

### Conditional Columns Using CASE

```sql
SELECT column_name,
       CASE
         WHEN condition1 THEN 'Label1'
         WHEN condition2 THEN 'Label2'
         ELSE 'DefaultLabel'
       END AS new_column
FROM table_name;
```

### Conditional Columns Using IF (MySQL)

```sql
SELECT column_name,
       IF(condition, 'TrueValue', 'FalseValue') AS new_column
FROM table_name;
```