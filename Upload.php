<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elearn";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$subject_name = $_POST['subject_name'];
$topic_name = $_POST['topic_name'];
$topic_content = $_POST['topic_content'];

// Insert subject into Subjects table
$sqlSubject = "INSERT INTO Subjects (subject_name) VALUES ('$subject_name')";
$conn->query($sqlSubject);

// Get the subject_id of the inserted subject
$subject_id = $conn->insert_id;

// Insert topic into Syllabus table
$sqlTopic = "INSERT INTO Syllabus (subject_id, topic_name) VALUES ($subject_id, '$topic_name')";
$conn->query($sqlTopic);

// Get the topic_id of the inserted topic
$topic_id = $conn->insert_id;

// Insert content into TopicContent table
$sqlContent = "INSERT INTO TopicContent (topic_id, content_text) VALUES ($topic_id, '$topic_content')";
$conn->query($sqlContent);

// Close the database connection
$conn->close();

// Redirect back to the upload form
header("Location: upload.html");
exit();
?>
