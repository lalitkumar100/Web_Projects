<?php
$servername = "localhost";
$username = "root"; // Your database username
$password = "";     // Your database password
$dbname = "student_registration"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentName = $_POST['studentName'];
    $usnNo = $_POST['usnNo'];
    $semester = $_POST['semester'];
    $subjectName = $_POST['subjectName'];
    $courseCode = $_POST['courseCode'];
    $marksObtained = $_POST['marksObtained'];
    $grade = $_POST['grade1'];

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO student_marks (student_name, usn_no, semester, subject_name, course_code, marks_obtained, grade) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissis", $studentName, $usnNo, $semester, $subjectName, $courseCode, $marksObtained, $grade);

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
