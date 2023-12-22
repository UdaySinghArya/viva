<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learn</title>
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="CSS/Nav.css"> -->
    <link rel="stylesheet" href="CSS/swiper-bundle.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/Navbar.css">
    <link rel="stylesheet" href="CSS/homeSlider.css">
    <link rel="stylesheet" href="CSS/HomeSearchBar.css">
    <link rel="stylesheet" href="CSS/CourseCard.css">
    <link rel="stylesheet" href="CSS/ShowCourse.css">
    <link rel="stylesheet" href="CSS/welcome.css">
    <script src="js/homeSlider"></script>

    <!-- Add this in the head section of your HTML file -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->

    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
    <style>
        
    </style>

</head>

<body>
    <?php include 'Partial/header.php' ?>





    <div class="welcome">
        <h1>Welcome to my website </h1>

        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search...">
            <button class="search-icon">&#128269;</button>
        </div>

        <?php
        include 'CourseCard.php';
        ?>
    </div>

    <!-- Main Container -->

    <center>
        <h1 class="CourseRecommed">Programming Languages</h1>
    </center>

    <?php
    include 'Languages.php';
    ?>

    <center>
        <h1 class="CourseRecommed">Mobile App Development Course</h1>
    </center>

    <?php
    include 'AppDevelopment.php';
    ?>

    <center>
        <h1 class="CourseRecommed">Website Development Course</h1>
    </center>

    <?php
       include 'WebDevelopment.php';
    ?>

    <!-- Add this script at the end of your body or in a separate script file -->

    <script src="js/ShowCourse.js"></script>



    <!-- JavaScript -->
    <script src="js/script.js"></script>
    <!-- Footer  -->

    <?php include 'partial/footer.php' ?>
</body>

</html>