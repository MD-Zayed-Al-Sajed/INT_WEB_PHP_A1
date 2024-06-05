<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
</head>
<body>
    <header>
        <img src="images/LOGO.jpeg" alt="Logo">
        <h1>Employee Management Portal</h1>
    </header>
    <div class="container">
    
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "employee_management";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["update"])) {
                
                // Update employee data
                $employeeID = $_POST["employeeID"];
                $firstName = $_POST["updateFirstName"];
                $lastName = $_POST["updateLastName"];
                $position = $_POST["updatePosition"];
                $department = $_POST["updateDepartment"];
                $email = $_POST["updateEmail"];
                $phoneNumber = $_POST["updatePhoneNumber"];
                $status = $_POST["updateStatus"];

                // Prepare and bind
                $stmt = $conn->prepare("UPDATE Employees SET FirstName=?, LastName=?, Position=?, Department=?, Email=?, PhoneNumber=?, Status=? WHERE EmployeeID=?");
                $stmt->bind_param("sssssssi", $firstName, $lastName, $position, $department, $email, $phoneNumber, $status, $employeeID);

                if ($stmt->execute()) {
                    echo "Record updated successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                // Insert new employee data
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $position = $_POST["position"];
                $department = $_POST["department"];
                $email = $_POST["email"];
                $phoneNumber = $_POST["phoneNumber"];
                $status = $_POST["status"];

                $stmt = $conn->prepare("INSERT INTO Employees (FirstName, LastName, Position, Department, Email, PhoneNumber, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $firstName, $lastName, $position, $department, $email, $phoneNumber, $status);

                if ($stmt->execute()) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }
        }

        
        $conn->close();
        ?>

        <div class="forms-container">
            <div>
                <h2>Add New Employee</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>

                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>

                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" required>

                    <label for="department">Department:</label>
                    <input type="text" id="department" name="department" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" required>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>

                    <input type="submit" value="Submit">
                </form>
            </div>

            <div>
                <h2>Update Employee Data</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="employeeID">Employee ID:</label>
                    <input type="number" id="employeeID" name="employeeID" required>

                    <label for="updateFirstName">First Name:</label>
                    <input type="text" id="updateFirstName" name="updateFirstName" required>

                    <label for="updateLastName">Last Name:</label>
                    <input type="text" id="updateLastName" name="updateLastName" required>

                    <label for="updatePosition">Position:</label>
                    <input type="text" id="updatePosition" name="updatePosition" required>

                    <label for="updateDepartment">Department:</label>
                    <input type="text" id="updateDepartment" name="updateDepartment" required>

                    <label for="updateEmail">Email:</label>
                    <input type="email" id="updateEmail" name="updateEmail" required>

                    <label for="updatePhoneNumber">Phone Number:</label>
                    <input type="text" id="updatePhoneNumber" name="updatePhoneNumber" required>

                    <label for="updateStatus">Status:</label>
                    <select id="updateStatus" name="updateStatus" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>

                    <input type="hidden" name="update" value="1">
                    <input type="submit" value="Update">
                </form>
            </div>
        </div>

        <div class="button-container">
            <form method="get" action="view_content.php">
                <button type="submit">View Data</button>
            </form>
        </div>

        <div class="footer">
            <p>&copy; 2024 Employee Management System</p>
        </div>
    </div>

</body>
</html>
