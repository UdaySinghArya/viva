<?php

include 'db.php';

// Trigger for Subjects Table
$sql_subjects_trigger = "
CREATE TRIGGER before_update_subjects_backup
BEFORE UPDATE
ON Subjects
FOR EACH ROW
BEGIN
    -- Create a backup of the old values in SubjectsBackup table
    INSERT INTO SubjectsBackup (subject_id, subject_name)
    VALUES (OLD.subject_id, OLD.subject_name);
END;
";

// Trigger for Syllabus Table
$sql_syllabus_trigger = "
CREATE TRIGGER before_update_syllabus_backup
BEFORE UPDATE
ON Syllabus
FOR EACH ROW
BEGIN
    -- Create a backup of the old values in SyllabusBackup table
    INSERT INTO SyllabusBackup (topic_id, topic_name, subject_id)
    VALUES (OLD.topic_id, OLD.topic_name, OLD.subject_id);
END;
";

// Trigger for TopicContent Table
$sql_topiccontent_trigger = "
CREATE TRIGGER before_update_topiccontent_backup
BEFORE UPDATE
ON TopicContent
FOR EACH ROW
BEGIN
    -- Create a backup of the old values in TopicContentBackup table
    INSERT INTO TopicContentBackup (content_id, content, topic_id)
    VALUES (OLD.content_id, OLD.content, OLD.topic_id);
END;
";

// Execute trigger creation SQL statements
$conn->multi_query($sql_subjects_trigger . $sql_syllabus_trigger . $sql_topiccontent_trigger);

// Check if triggers were created successfully
if ($conn->errno) {
    echo "Trigger creation failed: " . $conn->error;
} else {
    echo "Triggers created successfully!";
}

// Close the connection
$conn->close();
?>
