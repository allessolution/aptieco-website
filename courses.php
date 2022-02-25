<?php include 'include/header.php' ?>
<title>Courses - Aptieco</title>
<!-- seo tags here start -->
<meta name="description" content="We're Aptieco, Team Of Passionate, Experienced And Dedicated People Vision To Accredit Young
Minds And Enable Them To Make Choices To Explore A Future They Deserve.">

<meta property="og:title" content="Courses - Aptieco" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://aptieco.com/courses.php" />
<meta property="og:image" content="https://aptieco.com/assets/image/ogimage.webp" />
<meta property="og:image:width" content="526" />
<meta property="og:image:height" content="275" />
<meta property="og:image:type" content="image/jpeg" />
<meta name="twitter:card" content="summary_large_image" />
<meta property="og:description" content="We're Aptieco, Team Of Passionate, Experienced And Dedicated People Vision To Accredit Young
Minds And Enable Them To Make Choices To Explore A Future They Deserve." />
<meta property="og:site_name" content="Courses - Aptieco" />
<!-- seo tags ends -->
</head>
<?php 
include 'include/db.php';
$query=$db->query('SELECT * from courses');
?>
<body>
    <?php include 'include/nav.php' ?>
    <section class="all-courses">
        <h1 class="heading">#All<span> Courses</span></h1>
        <div class="box-container">
        <?php while ($data=$query->fetch()) {?>
            <div class="box">
                <img src="assets/image/courses/<?php echo $data['image'] ?>" alt="">
                <div class="content">
                    <h3><?php echo $data['c_heading'] ?></h3>
                    <p> Last updated: <?php echo $data['date'] ?></p>
                    <div class="price">₹<?php echo $data['c_fee'] ?>/-</div>
                    <a href="course_details.php?id=<?php echo $data['id']?>"><button class="btn">View Details</button></a>
                </div>
            </div>
        <?php } ?>
        </div>

    </section>
<?php include 'include/footer.php' ?>