<?php 
include 'include/db.php';
$query=$db->prepare('SELECT * from courses where id=?');
$query->execute(array($_GET['id']));
$data=$query->fetch();
?>
<?php include 'include/header.php' ?>
<title><?php echo $data['c_heading']?> - Aptieco</title>
<!-- seo tags here start -->
<meta name="description" content="<?php echo $data['c_heading']?>">

<meta property="og:title" content="<?php echo $data['c_heading']?> - Aptieco" />
<meta property="og:type" content="article" />
<meta property="og:url" content="https://aptieco.com/course_details.php?id=<?php echo $data['id']?>" />
<meta property="og:image" content="https://aptieco.com/assets/image/courses/<?php echo $data['image']?>" />
<meta property="og:description" content="<?php echo $data['c_heading']?>" />
<meta property="og:site_name" content="<?php echo $data['c_heading']?> - Aptieco" />
<!-- seo tags ends -->
</head>
<body>
<?php include 'include/nav.php' ?>
    <section class="course-details" id="home">
        <p style="margin:2rem 0rem"><a style="color:black;" href="courses.php">Courses</a> /<a class="active" href="course_details.php?id=<?php echo $data['id'] ?>">Course Detail</a></p>
        <img src="assets/image/courses/<?php echo $data['image'] ?>" alt="">
        <h1><?php echo $data['c_heading'] ?></h1>
        <h3>Course Information</h3>
        <ul>
            <li>
                <span>Registration Fee</span>
                <span>₹<?php echo $data['c_rfee'] ?></span>
            </li>
            <li>
                <span>Course Price</span>
                <span>₹<?php echo $data['c_fee'] ?></span>
            </li>
            <li>
                <span>Course Duration</span>
                <span><?php echo $data['c_duration'] ?> Months</span>
            </li>
        </ul>
        <h3>Description</h3>
        <p><?php echo $data['c_desc']?></p>
    </section>

    <section class="recommended-courses">
        <h1>Recommended Courses</h1>
        <div class="box-container">
        <?php
        $i=0;
        $query=$db->query('SELECT * FROM courses ORDER BY ID DESC');
        while ($data2=$query->fetch()) {
            if ($i==3) {
                break;
            }
            ?>
            <div class="box">
                <img src="assets/image/courses/<?php echo $data2['image'] ?>" alt="">
                <div class="content">
                    <h3><?php echo $data2['c_heading'] ?></h3>
                    <div class="price">₹<?php echo $data2['c_fee'] ?>/-</div>
                    <a href="course_details.php?id=<?php echo $data2['id']?>"><button class="btn">View Details</button></a>
                </div>
            </div>
        <?php
        $i=$i+1; } ?>
        </div>

    </section>
<?php include 'include/footer.php' ?>