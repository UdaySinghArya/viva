<?php
// update.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['type']) && isset($_GET['ID'])) {
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

    // Update record based on type and ID
    if ($type == 'subject') {
        $name = $_POST['name'];
        $sql = "UPDATE Subjects SET subject_name = '$name' WHERE subject_id = $id";
    } elseif ($type == 'topic') {
        // Update logic for topics (add your specific fields to update)
        // $field = $_POST['field'];
        // $sql = "UPDATE Syllabus SET field = '$value' WHERE topic_id = $id";
    } else {
        // Handle invalid type
        die("Invalid type");
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
