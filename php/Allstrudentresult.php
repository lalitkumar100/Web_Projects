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

// Fetch students' data
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <thead style='background-color: aqua;'>
            <tr>
                <th>S.NO</th>
                <th>Name</th>
                <th>USN</th>
                <th>22CSC400</th>
                <th>22CSC401</th>
                <th>22CSC402</th>
                <th>22CSC403</th>
                <th>Obtained Marks</th>
                <th>Total Marks</th>
                <th>Grade</th>
                <th>Credit</th>
                <th>Total Credit</th>
            </tr>
        </thead>
        <tbody>";

    // Output data of each row
    $sn = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $sn++ . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["usn"] . "</td>
                <td>" . $row["csc400"] . "</td>
                <td>" . $row["csc401"] . "</td>
                <td>" . $row["csc402"] . "</td>
                <td>" . $row["csc403"] . "</td>
                <td>" . $row["obtained_marks"] . "</td>
                <td>" . $row["total_marks"] . "</td>
                <td>" . $row["grade"] . "</td>
                <td>" . $row["credit"] . "</td>
                <td>" . $row["total_credit"] . "</td>
            </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
