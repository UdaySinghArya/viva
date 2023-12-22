<?php include 'partial/fetchSubjectName.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
</head>

<body>
    <!-- Your existing HTML structure here -->

    <!-- Content Container -->
    <div id="subject-content-container" class="container">
        <?php foreach ($subjects as $subject): ?>
            <div id="<?php echo $subject['subject_id']; ?>-content" class="subject-content">
                <h2><?php echo $subject['subject_name']; ?></h2>
                <p></p>
                <!-- Additional content as needed -->
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Your existing JavaScript and other HTML content here -->
</body>

</html>
