<?php include 'partial/fetchSubjectName.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Slider</title>
    <link rel="stylesheet" href="CSS/Tutorial.css">
    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
    <style>

    </style>
</head>

<body>
    <?php include 'partial/header.php' ?>
    <!-- Subject Slide bar -->
    <div class="slider-controls">
        <button class="control-btn" onclick="prevSlide()">Prev</button>
        <div class="subject">
            <ul class="sublist">
                <?php foreach ($subjects as $subject): ?>
                    <li><a href="tutorial.php?subject_id=<?php echo $subject['subject_id']; ?>">
                            <?php echo $subject['subject_name']; ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <button class="control-btn" onclick="nextSlide()">Next</button>
    </div>

    <?php
    // If a specific subject is selected, show its topics
    if (isset($_GET['subject_id'])) {
        $selectedSubjectId = $_GET['subject_id'];
        $topicQuery = "SELECT * FROM Syllabus WHERE subject_id = $selectedSubjectId";
        $topicResult = mysqli_query($conn, $topicQuery);

        $topics = array();

        while ($topicRow = mysqli_fetch_assoc($topicResult)) {
            $topics[] = $topicRow;
        }
        ?>
        <!-- The sidebar -->
        <button id="toggle">&#9776; Toggle Sidebar</button>
        <div class="sidebar">
            <h2>Topics</h2>
            <ul class="topicList">
                <?php foreach ($topics as $topic): ?>
                    <li><a
                            href="tutorial.php?subject_id=<?php echo $selectedSubjectId; ?>&topic_id=<?php echo $topic['topic_id']; ?>">
                            <?php echo $topic['topic_name']; ?>
                        </a></li>
                <?php endforeach; ?>
            </ul>
            <a href="#" class="closebtn">&times;</a>
        </div>

        <?php
        // If a specific topic is selected, show its content
        if (isset($_GET['topic_id'])) {
            $selectedTopicId = $_GET['topic_id'];
            $contentQuery = "SELECT * FROM TopicContent WHERE topic_id = $selectedTopicId";
            $contentResult = mysqli_query($conn, $contentQuery);

            $content = array();

            while ($contentRow = mysqli_fetch_assoc($contentResult)) {
                $content[] = $contentRow;
            }
            ?>
         
<!-- Main Content -->
<div class="mainContainer">
    <?php foreach ($content as $item): ?>
        <?php
        $selectedTopic = array_filter($topics, function ($topic) use ($selectedTopicId) {
            return $topic['topic_id'] == $selectedTopicId;
        });
        $selectedTopic = reset($selectedTopic);
        ?>
        <h2><?php echo isset($selectedTopic['topic_name']) ? $selectedTopic['topic_name'] : ''; ?></h2>
        <p><?php echo $item['content']; ?></p>
    <?php endforeach; ?>
</div>



        <?php } else { ?>
            <!-- Main Content when a topic is not selected -->
            <div class="mainContainer">
            
                <h1>Introduction to <?php echo $subjects[array_search($selectedSubjectId, array_column($subjects, 'subject_id'))]['subject_name']; ?></h1>
                </h1>
                <p>Add your introduction content here.</p>
            </div>
        <?php } ?>

        <?php } else { ?>
    <!-- Main Content when no subject is selected -->
    <div class="mainContainer">
        <h1>Greetings and Welcome!</h1>
        <p>Select a subject from the slider to get started.</p>
    </div>
    <?php
    // Reset selectedSubjectId to the first subject when no subject is selected
    $selectedSubjectId = isset($subjects[0]['subject_id']) ? $subjects[0]['subject_id'] : null;
    ?>
<?php } ?>


    <script src="js/Tutorial.js"></script>
    <?php include 'partial/footer.php' ?>
</body>

</html>