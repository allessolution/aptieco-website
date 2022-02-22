<!-- session check -->
<?php 
  session_start();
  if (empty($_SESSION['user'])) {
    header('location:./');
  }
include 'include/header.php';
?>
<?php 
require_once 'include/db.php';
$query=$db->query('SELECT * from courses');
$data=$query->fetchall();
$conut=count($data);
?>
<body>
    <?php include 'include/nav.php';?>
    <div class="dashboard">
      <h2 class="text-center">
        Welcome <?php echo $_SESSION['username'] ?>!
      </h2>
      <div class="row row-cols-1 justify-content-center row-cols-md-3 row-cols-lg-4 g-4">
        <div class="col">
          <div class="card h-100">
            <div class="card-body text-center">
              <h1 class="card-title"><i class="fa-solid fa-book"></i></h1>
              <p class="card-text">Number Of Courses</p>
              <h2><?php echo $conut ?></h2>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body text-center">
              <h1 class="card-title"><i class="fa-solid fa-user"></i></h1>
              <p class="card-text">Number Of Admins</p>
              <h2>10</h2>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body text-center">
              <h1 class="card-title"><i class="fa-solid fa-users"></i></h1>
              <p class="card-text">Number Of Users</p>
              <h2>10</h2>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-body text-center">
              <h1 class="card-title"><i class="fa-solid fa-graduation-cap"></i></h1>
              <p class="card-text">Number Of Students</p>
              <h2>10</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'include/footer.php';?>
</body>
</html>