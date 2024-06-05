<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employees</title>
    <link rel="stylesheet" type="text/css" href="CSS/view_content.css">
</head>
<body>
    <header>
        <img src="images/LOGO.jpeg" alt="Logo">
        <h1>Employee informations</h1>
    </header>

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

    // Fetch data from Employees table
    $sql = "SELECT EmployeeID, FirstName, LastName, Position, Department, Email, PhoneNumber, Status FROM Employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Position</th><th>Department</th><th>Email</th><th>Phone Number</th><th>Status</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $statusClass = $row["Status"] == "Active" ? "status-active" : "status-inactive";
            echo "<tr>";
            echo "<td>" . $row["EmployeeID"] . "</td>";
            echo "<td>" . $row["FirstName"] . "</td>";
            echo "<td>" . $row["LastName"] . "</td>";
            echo "<td>" . $row["Position"] . "</td>";
            echo "<td>" . $row["Department"] . "</td>";
            echo "<td>" . $row["Email"] . "</td>";
            echo "<td>" . $row["PhoneNumber"] . "</td>";
            echo "<td class='" . $statusClass . "'>" . $row["Status"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close connection
    $conn->close();
    ?>
    <div class="footer">
        <p><h3>&copy; 2024 Employee Management System</h3></p>
    </div>
</body>
</html>
