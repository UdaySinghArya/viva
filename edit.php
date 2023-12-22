<?php
// edit.php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['type']) && isset($_GET['ID'])) {
    $type = $_GET['type'];
    $id = $_GET['ID'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "elearn";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data based on type and ID
    if ($type == 'subject') {
        $sql = "SELECT * FROM Subjects WHERE subject_id = $id";
    } elseif ($type == 'topic') {
        $sql = "SELECT * FROM Syllabus WHERE topic_id = $id";
    } else {
        // Handle invalid type
        die("Invalid type");
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display the form for editing
        echo "<h2>Edit $type</h2>";
        echo "<form method='post' action='update.php?type=$type&ID=$id'>";
        echo "Name: <input type='text' name='name' value='{$row['subject_name']}'>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "No record found";
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
