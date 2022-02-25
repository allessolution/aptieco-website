<?php include 'include/header.php' ?>
<title>Aptieco</title>
<!-- seo tags start -->
<meta name="description" content="We're Aptieco, Team Of Passionate, Experienced And Dedicated People Vision To Accredit Young
Minds And Enable Them To Make Choices To Explore A Future They Deserve.">

<meta property="og:title" content="Aptieco" />
<meta property="og:type" content="article" />
<meta property="og:url" content="https://aptieco.com/" />
<meta property="og:image" content="https://aptieco.com/assets/image/ogimage.webp" />
<meta property="og:description" content="We're Aptieco, Team Of Passionate, Experienced And Dedicated People Vision To Accredit Young
Minds And Enable Them To Make Choices To Explore A Future They Deserve." />
<meta property="og:site_name" content="Aptieco" />
<!-- seo tags ends -->
</head>
<?php 
include 'include/db.php';
$query=$db->query('SELECT * from courses where featured=1');
?>
<body>
    <?php include 'include/nav.php' ?>
    <section class="home" id="home">

        <h3 data-speed="-2" class="home-parallax">grow your skills</h3>

        <img data-speed="5" class="home-parallax" src="assets/image/home-img.png" alt="">
        <br>
        <br>
        <br>
        <button class="btn" id="login-btn" onclick=courses()>Enroll Now</button>&nbsp;&nbsp;&nbsp;
        <a href="courses.php"><button class="btn">View Courses</button></a>

    </section>

    <section class="icons-container">

        <div class="icons">
            <i class="fas fa-graduation-cap"></i>
            <div class="content">
                <h3>10+</h3>
                <p>courses</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-users"></i>
            <div class="content">
                <h3>500+</h3>
                <p>happy students</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-user"></i>
            <div class="content">
                <h3>10+</h3>
                <p>Teachers</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-book"></i>
            <div class="content">
                <h3>100+</h3>
                <p>currenlty studying</p>
            </div>
        </div>

    </section>

    <section class="courses" id="courses">

        <h1 class="heading"> Popular <span>Courses</span> </h1>

        <div class="swiper courses-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <img src="assets/image/course-1.png" alt="">
                    <div class="content">
                        <h3>Web Development</h3>
                        <div class="price"> <span>price : </span> ₹999/- </div>
                        <p>
                            HTML
                            <span class="fas fa-circle"></span> CSS
                            <span class="fas fa-circle"></span> PHP
                            <span class="fas fa-circle"></span> SQL
                            <span class="fas fa-circle"></span> JS
                        </p>
                        <a href="courses.php"><button class="btn">Explore course</button></a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/course-2.png" alt="">
                    <div class="content">
                        <h3>Digital Marketing</h3>
                        <div class="price"> <span>price : </span> ₹999/- </div>
                        <p>
                            Marketing Strategy
                            <span class="fas fa-circle"></span> SEO
                            <span class="fas fa-circle"></span> SMM
                            <span class="fas fa-circle"></span> SEM
                            <span class="fas fa-circle"></span> Online content & Blogging
                        </p>
                        <a href="courses.php"><button class="btn">Explore course</button></a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/course-3.png" alt="">
                    <div class="content">
                        <h3>C Programming </h3>
                        <div class="price"> <span>price : </span> ₹999/- </div>
                        <p>
                            Features
                            <span class="fas fa-circle"></span> Datatypes
                            <span class="fas fa-circle"></span> Operators
                            <span class="fas fa-circle"></span> Loops & Arrays
                            <span class="fas fa-circle"></span> Functions
                        </p>
                        <a href="courses.php"><button class="btn">Explore course</button></a>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <section class="services" id="services">

        <h1 class="heading"> How we are different from <span>others?</span> </h1>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-user"></i>
                <h3>Best Mentors</h3>
                <p>Our team provides you with best faculty members who have great expertise in their offered course.<br>
                    They are available to look into your doubts 24/7.
                </p>
            </div>

            <div class="box">
                <i class="fas fa-book"></i>
                <h3>Easy to understand notes</h3>
                <p>Aptieco provides students simple and up-to-dated notes to revise and understand the topic at their
                    pace.</p>
            </div>

            <div class="box">
                <i class="fas fa-rupee-sign"></i>
                <h3>Affordability</h3>
                <p>The price of our offered courses is at students pocket friendly level. Everyone can spare the price
                    of courses easily.</p>
            </div>

            <div class="box">
                <i class="fas fa-pen"></i>
                <h3>Test Series</h3>
                <p>We provide a lot of project and test series to the students with which they can boost up their
                    respective domains. Moreover, these test series are internship and job oriented.</p>
            </div>

        </div>

    </section>

    <section class="featured" id="featured">

        <h1 class="heading"><span>#featured</span> Courses</h1>

        <div class="swiper featured-slider">

            <div class="swiper-wrapper">
                <?php while ($data=$query->fetch()) {?>
                    <div class="swiper-slide box">
                        <img src="assets/image/courses/<?php echo $data['image'] ?>" alt="">
                        <div class="content">
                            <h3><?php echo $data['c_heading'] ?></h3>
                            <p> Last updated: <?php echo $data['date'] ?></p>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <div class="price">₹<?php echo $data['c_fee'] ?>/-</div>
                            <a href="course_details.php?id=<?php echo $data['id']?>"><button class="btn">View Details</button></a>
                        </div>
                    </div>
                <?php }?>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>

    <section class="newsletter">

        <h3>subscribe for latest updates</h3>
        <p>Wanna get updated with our upcoming new courses and offers? Subscribe now.</p>

        <form action="">
            <input type="email" placeholder="enter your email">
            <input type="submit" value="subscribe">
        </form>

    </section>

    <section class="reviews" id="reviews">

        <h1 class="heading">#Student's <span>review</span> </h1>

        <div class="swiper review-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <img src="assets/image/students/Shaina Sharma student.jpg" alt="">
                    <div class="content">
                        <p>I not only built my technical skills but also had such a great time during bootcamp
                            sessions.It was so different from other online learning platforms as it was not at all
                            monotonous!!Well done Aptieco!!!</p>
                        <h3>Shaina Sharma</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/students/Anurag Vaibhav student.jpg" alt="">
                    <div class="content">
                        <p>C programming was one of the best bootcamps I have attended by far. Everything from the
                            videos to assignments and advanced tests are amazing and informative. It has helped me
                            tremendously. I encourage everyone to take it!!!</p>
                        <h3>Anurag Vaibhav</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/students/Geetika.jpeg"  alt="">
                    <div class="content">
                        <p>Firstly, I must say that the mentors od Aptieco are by far the most friendly and polite
                            mannered ones i have ever come across.They were always ready to look into the doubts and
                            query as early as possible! Overall it was a great experience for me!!.</p>
                        <h3>Geetika</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/pic-1.png" alt="">
                    <div class="content">
                        <p>From this 4 weeks long digital marketing bootcamp, I learned far more than I did from the
                            4-year on-campus studying. My digital marketing skills has improved so much. I would highly
                            recommend my peers to join aptieco's bootcamp ASAP!!!</p>
                        <h3>Akanksha</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/students/ayush.jpeg" alt="">
                    <div class="content">
                        <p>Very nicely explained bootcamp...after the completion of my course..i must say my graphic
                            designing skills are at top notch level!!!</p>
                        <h3>Ayush</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <img src="assets/image/students/Samiksha Sain student.jpg" alt="">
                    <div class="content">
                        <p>absolutely interactive bootcamp! This bootcamp boost my Web developing skills a lot, helped
                            me understand each topic a lot better in fun and easy way, with a solid perception about
                            Javascripting and other important Topics.</p>
                        <h3>Samiksha Sain</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>
<?php include 'include/footer.php' ?>