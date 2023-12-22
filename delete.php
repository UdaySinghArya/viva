<?php
// delete.php

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

    // Delete record based on type and ID
    if ($type == 'subject') {
        $sql = "DELETE FROM Subjects WHERE subject_id = $id";
    } elseif ($type == 'topic') {
        $sql = "DELETE FROM Syllabus WHERE topic_id = $id";
    } else {
        // Handle invalid type
        die("Invalid type");
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
