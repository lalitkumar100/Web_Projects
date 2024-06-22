<?php
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = "";     // Change this to your MySQL password
$dbname = "student_registration"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $fatherName = $_POST['father-name'];
    $usn = $_POST['usn'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $branch = $_POST['branch'];

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO students (name, father_name, usn, gender, dob, branch) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $fatherName, $usn, $gender, $dob, $branch);

    // Execute statement and check if successful
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>
