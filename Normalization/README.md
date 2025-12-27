### Example-1: Student Course Enrollment

#### Original Flat Table: EnrollmentDetails
| StudentID | CourseID | StudentName | StudentCity | CourseName | InstructorName | InstructorPhone | Grade |
| --------- | -------- | ----------- | ----------- | ---------- | -------------- | --------------- | ----- |
| S01       | C101     | Alice       | Dhaka       | DBMS       | Dr. Khan       | 555-0101        | A     |
| S01       | C102     | Alice       | Dhaka       | OS         | Dr. Lee        | 555-0102        | B     |
| S02       | C101     | Bob         | Chittagong  | DBMS       | Dr. Khan       | 555-0101        | A     |
| S02       | C103     | Bob         | Chittagong  | Networks   | Dr. Roy        | 555-0103        | B     |

**Composite Primary Key:** (StudentID, CourseID)  

**Partial Key Dependencies (violating 2NF):**
- StudentName, StudentCity → depend only on StudentID (part of the composite key)
- CourseName, InstructorName, InstructorPhone → depend only on CourseID (part of the composite key)

#### Result After Normalization to 2NF
#### Student
| StudentID | StudentName | StudentCity |
| --------- | ----------- | ----------- |
| S01       | Alice       | Dhaka       |
| S02       | Bob         | Chittagong  |

#### Course
| CourseID | CourseName | InstructorName | InstructorPhone |
| -------- | ---------- | -------------- | --------------- |
| C101     | DBMS       | Dr. Khan       | 555-0101        |
| C102     | OS         | Dr. Lee        | 555-0102        |
| C103     | Networks   | Dr. Roy        | 555-0103        |

#### Enrollment
| StudentID | CourseID | Grade |
| --------- | -------- | ----- |
| S01       | C101     | A     |
| S01       | C102     | B     |
| S02       | C101     | A     |
| S02       | C103     | B     |

**Transitive Dependency (violating 3NF):**
- In the **Course** table: InstructorName → InstructorPhone  
  (InstructorPhone depends on InstructorName, which is a non-key attribute)

#### Result After Normalization to 3NF
#### Instructor
| InstructorName | InstructorPhone |
| -------------- | --------------- |
| Dr. Khan       | 555-0101        |
| Dr. Lee        | 555-0102        |
| Dr. Roy        | 555-0103        |

#### Course
| CourseID | CourseName | InstructorName |
| -------- | ---------- | -------------- |
| C101     | DBMS       | Dr. Khan       |
| C102     | OS         | Dr. Lee        |
| C103     | Networks   | Dr. Roy        |

#### Student (unchanged)
| StudentID | StudentName | StudentCity |
| --------- | ----------- | ----------- |
| S01       | Alice       | Dhaka       |
| S02       | Bob         | Chittagong  |

#### Enrollment (unchanged)
| StudentID | CourseID | Grade |
| --------- | -------- | ----- |
| S01       | C101     | A     |
| S01       | C102     | B     |
| S02       | C101     | A     |
| S02       | C103     | B     |

---

### Example-2: Sales Order Items

#### Original Flat Table: OrderItems
| OrderID | ProductID | CustomerName | CustomerCity | ProductName | CategoryName | CategoryManager | Quantity |
| ------- | --------- | ------------ | ------------ | ----------- | ------------ | --------------- | -------- |
| O01     | P10       | Rahim        | Dhaka        | Mouse       | Accessories  | Mr. Lee         | 2        |
| O01     | P11       | Rahim        | Dhaka        | Keyboard    | Accessories  | Mr. Lee         | 1        |
| O02     | P10       | Karim        | Sylhet       | Mouse       | Accessories  | Mr. Lee         | 3        |
| O02     | P12       | Karim        | Sylhet       | Monitor     | Display      | Ms. Kim         | 1        |

**Composite Primary Key:** (OrderID, ProductID)  

**Partial Key Dependencies (violating 2NF):**
- CustomerName, CustomerCity → depend only on OrderID
- ProductName, CategoryName, CategoryManager → depend only on ProductID

#### Result After Normalization to 2NF
#### CustomerOrder
| OrderID | CustomerName | CustomerCity |
| ------- | ------------ | ------------ |
| O01     | Rahim        | Dhaka        |
| O02     | Karim        | Sylhet       |

#### Product
| ProductID | ProductName | CategoryName | CategoryManager |
| --------- | ----------- | ------------ | --------------- |
| P10       | Mouse       | Accessories  | Mr. Lee         |
| P11       | Keyboard    | Accessories  | Mr. Lee         |
| P12       | Monitor     | Display      | Ms. Kim         |

#### OrderDetail
| OrderID | ProductID | Quantity |
| ------- | --------- | -------- |
| O01     | P10       | 2        |
| O01     | P11       | 1        |
| O02     | P10       | 3        |
| O02     | P12       | 1        |

**Transitive Dependency (violating 3NF):**
- In the **Product** table: CategoryName → CategoryManager  
  (CategoryManager depends on CategoryName, a non-key attribute)

#### Result After Normalization to 3NF
#### Category
| CategoryName | CategoryManager |
| ------------ | --------------- |
| Accessories  | Mr. Lee         |
| Display      | Ms. Kim         |

#### Product
| ProductID | ProductName | CategoryName |
| --------- | ----------- | ------------ |
| P10       | Mouse       | Accessories  |
| P11       | Keyboard    | Accessories  |
| P12       | Monitor     | Display      |

#### CustomerOrder (unchanged)
| OrderID | CustomerName | CustomerCity |
| ------- | ------------ | ------------ |
| O01     | Rahim        | Dhaka        |
| O02     | Karim        | Sylhet       |

#### OrderDetail (unchanged)
| OrderID | ProductID | Quantity |
| ------- | --------- | -------- |
| O01     | P10       | 2        |
| O01     | P11       | 1        |
| O02     | P10       | 3        |
| O02     | P12       | 1        |

---

### Example-3: Employee Project Assignment

#### Original Flat Table: EmployeeProjectDetails
| EmpID | ProjectID | EmpName | DeptName | DeptLocation | ProjectName | ProjectBudget | HoursWorked |
| ----- | --------- | ------- | -------- | ------------ | ----------- | ------------- | ----------- |
| E01   | PR1       | Alice   | IT       | Dhaka        | AppDev      | 500000        | 20          |
| E01   | PR2       | Alice   | IT       | Dhaka        | WebDev      | 300000        | 15          |
| E02   | PR1       | Bob     | HR       | Chittagong   | AppDev      | 500000        | 25          |

**Composite Primary Key:** (EmpID, ProjectID)  

**Partial Key Dependencies (violating 2NF):**
- EmpName, DeptName, DeptLocation → depend only on EmpID
- ProjectName, ProjectBudget → depend only on ProjectID

#### Result After Normalization to 2NF
#### Employee
| EmpID | EmpName | DeptName | DeptLocation |
| ----- | ------- | -------- | ------------ |
| E01   | Alice   | IT       | Dhaka        |
| E02   | Bob     | HR       | Chittagong   |

#### Project
| ProjectID | ProjectName | ProjectBudget |
| --------- | ----------- | ------------- |
| PR1       | AppDev      | 500000        |
| PR2       | WebDev      | 300000        |

#### Assignment
| EmpID | ProjectID | HoursWorked |
| ----- | --------- | ----------- |
| E01   | PR1       | 20          |
| E01   | PR2       | 15          |
| E02   | PR1       | 25          |

**Transitive Dependencies (violating 3NF):**
- In **Employee** table: DeptName → DeptLocation
- In **Project** table: ProjectName → ProjectBudget

#### Result After Normalization to 3NF
#### Department
| DeptName | DeptLocation |
| -------- | ------------ |
| IT       | Dhaka        |
| HR       | Chittagong   |

#### ProjectInfo
| ProjectName | ProjectBudget |
| ----------- | ------------- |
| AppDev      | 500000        |
| WebDev      | 300000        |

#### Employee
| EmpID | EmpName | DeptName |
| ----- | ------- | -------- |
| E01   | Alice   | IT       |
| E02   | Bob     | HR       |

#### Project
| ProjectID | ProjectName |
| --------- | ----------- |
| PR1       | AppDev      |
| PR2       | WebDev      |

#### Assignment (unchanged)
| EmpID | ProjectID | HoursWorked |
| ----- | --------- | ----------- |
| E01   | PR1       | 20          |
| E01   | PR2       | 15          |
| E02   | PR1       | 25          |

---

### Example-4: Library Book Borrowing

#### Original Flat Table: BorrowingDetails
| MemberID | BookID | MemberName | MemberType | LateFeeRate | BookTitle | PublisherName | PublisherCity | BorrowDate |
| -------- | ------ | ---------- | ---------- | ----------- | --------- | ------------- | ------------- | ---------- |
| M01      | B101   | Rahim      | Student    | 10          | DBMS      | Pearson       | New York      | 2025-01-10 |
| M01      | B102   | Rahim      | Student    | 10          | OS        | Wiley         | Boston        | 2025-01-15 |
| M02      | B101   | Karim      | Faculty    | 0           | DBMS      | Pearson       | New York      | 2025-01-12 |

**Composite Primary Key:** (MemberID, BookID)  

**Partial Key Dependencies (violating 2NF):**
- MemberName, MemberType, LateFeeRate → depend only on MemberID
- BookTitle, PublisherName, PublisherCity → depend only on BookID

#### Result After Normalization to 2NF
#### Member
| MemberID | MemberName | MemberType | LateFeeRate |
| -------- | ---------- | ---------- | ----------- |
| M01      | Rahim      | Student    | 10          |
| M02      | Karim      | Faculty    | 0           |

#### Book
| BookID | BookTitle | PublisherName | PublisherCity |
| ------ | --------- | ------------- | ------------- |
| B101   | DBMS      | Pearson       | New York      |
| B102   | OS        | Wiley         | Boston        |

#### Borrowing
| MemberID | BookID | BorrowDate |
| -------- | ------ | ---------- |
| M01      | B101   | 2025-01-10 |
| M01      | B102   | 2025-01-15 |
| M02      | B101   | 2025-01-12 |

**Transitive Dependencies (violating 3NF):**
- In **Member** table: MemberType → LateFeeRate
- In **Book** table: PublisherName → PublisherCity

#### Result After Normalization to 3NF
#### MemberType
| MemberType | LateFeeRate |
| ---------- | ----------- |
| Student    | 10          |
| Faculty    | 0           |

#### Publisher
| PublisherName | PublisherCity |
| ------------- | ------------- |
| Pearson       | New York      |
| Wiley         | Boston        |

#### Member
| MemberID | MemberName | MemberType |
| -------- | ---------- | ---------- |
| M01      | Rahim      | Student    |
| M02      | Karim      | Faculty    |

#### Book
| BookID | BookTitle | PublisherName |
| ------ | --------- | ------------- |
| B101   | DBMS      | Pearson       |
| B102   | OS        | Wiley         |

#### Borrowing (unchanged)
| MemberID | BookID | BorrowDate |
| -------- | ------ | ---------- |
| M01      | B101   | 2025-01-10 |
| M01      | B102   | 2025-01-15 |
| M02      | B101   | 2025-01-12 |

---

### Example-5: Hospital Patient Appointments

#### Original Flat Table: AppointmentDetails
| PatientID | DoctorID | PatientName | PatientCity | DoctorName | Department | DeptHead   | AppointmentTime |
| --------- | -------- | ----------- | ----------- | ---------- | ---------- | ---------- | --------------- |
| P01       | D01      | Ali         | Dhaka       | Dr. Khan   | Cardiology | Dr. Rahman | 10:00           |
| P01       | D02      | Ali         | Dhaka       | Dr. Sen    | Neurology  | Dr. Gupta  | 11:00           |
| P02       | D01      | Bina        | Sylhet      | Dr. Khan   | Cardiology | Dr. Rahman | 10:30           |

**Composite Primary Key:** (PatientID, DoctorID)  

**Partial Key Dependencies (violating 2NF):**
- PatientName, PatientCity → depend only on PatientID
- DoctorName, Department, DeptHead → depend only on DoctorID

#### Result After Normalization to 2NF
#### Patient
| PatientID | PatientName | PatientCity |
| --------- | ----------- | ----------- |
| P01       | Ali         | Dhaka       |
| P02       | Bina        | Sylhet      |

#### Doctor
| DoctorID | DoctorName | Department | DeptHead   |
| -------- | ---------- | ---------- | ---------- |
| D01      | Dr. Khan   | Cardiology | Dr. Rahman |
| D02      | Dr. Sen    | Neurology  | Dr. Gupta  |

#### Appointment
| PatientID | DoctorID | AppointmentTime |
| --------- | -------- | --------------- |
| P01       | D01      | 10:00           |
| P01       | D02      | 11:00           |
| P02       | D01      | 10:30           |

**Transitive Dependency (violating 3NF):**
- In the **Doctor** table: Department → DeptHead  
  (DeptHead depends on Department, a non-key attribute)

#### Result After Normalization to 3NF
#### Department
| Department | DeptHead   |
| ---------- | ---------- |
| Cardiology | Dr. Rahman |
| Neurology  | Dr. Gupta  |

#### Doctor
| DoctorID | DoctorName | Department |
| -------- | ---------- | ---------- |
| D01      | Dr. Khan   | Cardiology |
| D02      | Dr. Sen    | Neurology  |

#### Patient (unchanged)
| PatientID | PatientName | PatientCity |
| --------- | ----------- | ----------- |
| P01       | Ali         | Dhaka       |
| P02       | Bina        | Sylhet      |

#### Appointment (unchanged)
| PatientID | DoctorID | AppointmentTime |
| --------- | -------- | --------------- |
| P01       | D01      | 10:00           |
| P01       | D02      | 11:00           |
| P02       | D01      | 10:30           |