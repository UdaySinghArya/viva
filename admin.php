<?php
// admin.php

// Include database connection code
include 'db.php';

// Function to fetch subjects
function getSubjects($conn) {
    $sql = "SELECT * FROM Subjects";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to fetch topics for a specific subject
function getTopics($conn, $subjectId) {
    $sql = "SELECT * FROM Syllabus WHERE subject_id = $subjectId";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// CRUD operations for Subjects
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create
    if (isset($_POST['create_subject'])) {
        $subject_name = $_POST['subject_name'];
        $sql = "INSERT INTO Subjects (subject_name) VALUES ('$subject_name')";
        $conn->query($sql);
    }

    // Update
    if (isset($_POST['update_subject'])) {
        $subject_id = $_POST['subject_id'];
        $new_subject_name = $_POST['new_subject_name'];
        $sql = "UPDATE Subjects SET subject_name = '$new_subject_name' WHERE subject_id = $subject_id";
        $conn->query($sql);
    }

    // Delete
    if (isset($_POST['delete_subject'])) {
        $subject_id = $_POST['subject_id'];
        $sql = "DELETE FROM Subjects WHERE subject_id = $subject_id";
        $conn->query($sql);
    }

    // Delete topic
    if (isset($_POST['delete_topic'])) {
        $topic_id = $_POST['topic_id'];
        $sql = "DELETE FROM Syllabus WHERE topic_id = $topic_id";
        $conn->query($sql);
    }
}

// Fetch subjects
$subjects = getSubjects($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Admin Panel</h2>

    <!-- Create Subject Form -->
    <form method="post" action="">
        <label for="subject_name">New Subject:</label>
        <input type="text" name="subject_name" required>
        <button type="submit" name="create_subject">Create Subject</button>
    </form>

    <!-- Subjects List -->
    <h3>Subjects:</h3>
    <ul>
        <?php foreach ($subjects as $subject): ?>
            <li>
                <?php echo $subject['subject_name']; ?>
                <!-- Update Subject Form -->
                <form method="post" action="">
                    <input type="hidden" name="subject_id" value="<?php echo $subject['subject_id']; ?>">
                    <input type="text" name="new_subject_name" required>
                    <button type="submit" name="update_subject">Update</button>
                </form>
                <!-- Delete Subject Form -->
                <form method="post" action="">
                    <input type="hidden" name="subject_id" value="<?php echo $subject['subject_id']; ?>">
                    <button type="submit" name="delete_subject">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Topics List for Selected Subject -->
    <?php if (!empty($subjects)): ?>
        <h3>Topics:</h3>
        <ul>
            <?php
            $selectedSubjectId = $subjects[0]['subject_id'];
            $topics = getTopics($conn, $selectedSubjectId);
            foreach ($topics as $topic): ?>
                <li>
                    <?php echo $topic['topic_name']; ?>
                    <!-- Delete Topic Form -->
                    <form method="post" action="">
                        <input type="hidden" name="topic_id" value="<?php echo $topic['topic_id']; ?>">
                        <button type="submit" name="delete_topic">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>

</html>
