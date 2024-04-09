<?php
// Database connection parameters
$servername = "localhost";  // Change this to your MySQL server address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "test2"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Full_Name = $_POST['Full_name'];
    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Phone_Number = $_POST['Phone_Number'];
    $Gender = $_POST['Gender'];
    $Password = $_POST['Password'];
 

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO users (Full_Name, Username, Email, Phone_Number, Gender, Password, ) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullName, $username, $gender, $email, $hashedPassword, $phoneNumber);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>