<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Result Entry</title>
</head>

<body>

<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student results data
$usn = '2SD22CS000';  // Assuming you are fetching the results for a specific USN
$sql = "SELECT * FROM results WHERE usn='$usn'";
$result = $conn->query($sql);

// Display student information
if ($result->num_rows > 0) {
    $student_info = $result->fetch_assoc();
    echo "<h1>Result</h1>
    <table border='1'>
        <tr>
            <td colspan='3'><span class='TITLE'>USN</span>: " . $student_info['usn'] . "</td>
            <td colspan='4'><span class='TITLE'>Status:</span> <span class='result'>" . $student_info['status'] . "</span></td>
        </tr>
        <tr>
            <td colspan='3'><span class='TITLE'>Branch</span>: " . $student_info['branch'] . "</td>
            <td colspan='4'><span class='TITLE'>Semester</span>: <span class='result'>" . $student_info['semester'] . "</span></td>
        </tr>
        <tr>
            <td colspan='7'><span class='TITLE'>Name</span>: " . $student_info['name'] . "</td>
        </tr>
        <tr>
            <th>S NO</th>
            <th>COURSE CODE</th>
            <th>COURSE NAME</th>
            <th>OBTAINED MARKS</th>
            <th>TOTAL MARKS</th>
            <th>GRADE</th>
            <th>CREDIT</th>
        </tr>";

    // Reset result pointer and fetch all rows
    $result->data_seek(0);
    $sn = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $sn++ . "</td>
            <td>" . $row['course_code'] . "</td>
            <td>" . $row['course_name'] . "</td>
            <td>" . $row['obtained_marks'] . "</td>
            <td>" . $row['total_marks'] . "</td>
            <td>" . $row['grade'] . "</td>
            <td>" . $row['credit'] . "</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<a href="index.html"><button>Back</button></a>

</body>

</html>
