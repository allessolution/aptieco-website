  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00a1ff;">
    <div class="container-fluid">
      <a class="navbar-brand" href="./">Aptieco</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php if (isset($_SESSION['user'])) { ?>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="add_course.php">Add Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="courses.php">All Courses</a>
          </li>
        </ul>
        <a href="logout.php">
          <i class="fa-solid fa-right-from-bracket"></i>
        </a>
      </div>
      <?php } ?>
    </div>
  </nav>
  <div class="alert-box">
    <div class="alert-msg col-lg-4 col-md-6 col-sm-12" id="alert">
    </div>
  </div>