<?php
include 'db.php';

// Function to fetch subjects from the database
function getSubjects()
{
    global $conn;
    $result = $conn->query("SELECT * FROM Subjects");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to fetch topics based on subject_id
function getTopics($subject_id)
{
    global $conn;
    $result = $conn->query("SELECT * FROM Syllabus WHERE subject_id = $subject_id");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to fetch topic content based on topic_id
function getTopicContent($topic_id)
{
    global $conn;
    $result = $conn->query("SELECT * FROM TopicContent WHERE topic_id = $topic_id");
    return $result->fetch_assoc();
}

// Fetch subjects
$subjects = getSubjects();

// Fetch topics for the selected subject
$selectedSubjectId = isset($_POST['subjectId']) ? $_POST['subjectId'] : null;
$topics = ($selectedSubjectId !== null) ? getTopics($selectedSubjectId) : [];

// Fetch content for the selected topic
$selectedTopicId = isset($_POST['topicId']) ? $_POST['topicId'] : null;
$topicContent = ($selectedTopicId !== null) ? getTopicContent($selectedTopicId) : null;

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addSubject'])) {
        $subjectName = $_POST['subjectName'];
        $conn->query("INSERT INTO Subjects (subject_name) VALUES ('$subjectName')");
    } elseif (isset($_POST['addTopic'])) {
        $topicName = $_POST['topicName'];
        $subjectId = $_POST['subjectId'];
        $conn->query("INSERT INTO Syllabus (topic_name, subject_id) VALUES ('$topicName', $subjectId)");
        // Fetch updated topics after adding a new topic
        $topics = getTopics($subjectId);
    } elseif (isset($_POST['addContent'])) {
        $content = $_POST['content'];
        $topicId = $_POST['topicId'];
        $conn->query("INSERT INTO TopicContent (content, topic_id) VALUES ('$content', $topicId)");
    } elseif (isset($_POST['selectSubject'])) {
        $selectedSubjectId = $_POST['subjectId'];
        // Fetch topics for the selected subject
        $topics = getTopics($selectedSubjectId);
        // Reset selected topic when subject changes
        $selectedTopicId = null;
    } elseif (isset($_POST['selectTopic'])) {
        $selectedTopicId = $_POST['topicId'];
        // Fetch content for the selected topic
        $topicContent = getTopicContent($selectedTopicId);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
</head>

<body>

    <h2>Add New Subject</h2>
    <form method="post">
        <label for="subjectName">Subject Name:</label>
        <input type="text" name="subjectName" required>
        <button type="submit" name="addSubject">Add Subject</button>
    </form>

    <h2>Add New Topic</h2>
    <form method="post">
        <label for="subjectId">Select Subject:</label>
        <select name="subjectId" required>
            <?php
            foreach ($subjects as $subject) {
                $selected = ($subject['subject_id'] == $selectedSubjectId) ? 'selected' : '';
                echo "<option value='{$subject['subject_id']}' $selected>{$subject['subject_name']}</option>";
            }
            ?>
        </select>
        <button type="submit" name="selectSubject">Select Subject</button>
        <br>
        <label for="topicName">Topic Name:</label>
        <input type="text" name="topicName" required>
        <button type="submit" name="addTopic">Add Topic</button>
    </form>

    <h2>Add Topic Content</h2>
    <form method="post">
        <?php if (!empty($topics)) : ?>
            <label for="topicId">Select Topic:</label>
            <select name="topicId" required>
                <?php
                foreach ($topics as $topic) {
                    $selected = ($topic['topic_id'] == $selectedTopicId) ? 'selected' : '';
                    echo "<option value='{$topic['topic_id']}' $selected>{$topic['topic_name']}</option>";
                }
                ?>
            </select>
            <button type="submit" name="selectTopic">Select Topic</button>
        <?php else : ?>
            <p>No topics available for the selected subject.</p>
        <?php endif; ?>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" required></textarea>
        <button type="submit" name="addContent">Add Content</button>
    </form>

    <h2>Subjects</h2>
    <ul>
        <?php
        foreach ($subjects as $subject) {
            echo "<li>{$subject['subject_name']}</li>";
        }
        ?>
    </ul>

    <h2>Topics</h2>
    <ul>
        <?php
        foreach ($topics as $topic) {
            echo "<li>{$topic['topic_name']}</li>";
        }
        ?>
    </ul>

    <h2>Topic Content</h2>
    <?php
    if (!empty($topics) && $topicContent !== null) {
        echo "<p>{$topicContent['content']}</p>";
    }
    ?>

</body>

</html>
