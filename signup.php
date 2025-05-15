<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default XAMPP MySQL username
$password = "";     // Default is no password
$dbname = "petadopt_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize form data
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO users (name, address, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $address, $email, $pass);

// Execute and check result
if ($stmt->execute()) {
    echo "Signup successful. <a href='login.html'>Login here</a>.";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
