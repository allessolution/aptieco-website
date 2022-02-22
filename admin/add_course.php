<!-- session check -->
<?php 
  session_start();
  if (empty($_SESSION['user'])) {
    header('location:./');
  }
?>
<?php include "include/header.php"?>
<body>
  <?php include "include/nav.php"?>


<!-- php code -->
<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
  include 'include/functions.php';
  $target_dir = "../image/courses/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $c_heading=$_POST['c_heading'];
  $c_crfee=$_POST['c_rfee'];
  $c_cfee=$_POST['c_fee'];
  $c_desc=$_POST['c_desc'];
  $c_duration=$_POST['c_duration'];
  $c_addedby=$_SESSION['username'];
  $date=date("Y-m-d H:i:s");
  $image=$_FILES["fileToUpload"]["name"];
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      alert2("File is an image - " . $check["mime"] . ".",'danger');
      $uploadOk = 1;
    } else {
      alert2("File is not an image.",'danger');
      $uploadOk = 0;
    }
  }
  elseif (empty($c_heading) or empty($c_crfee) or empty($c_cfee) or empty($c_duration) or empty($image)  ) {
    alert2('All fields are required','danger');
  }
  // Check if file already exists
  else if (file_exists($target_file)) {
    alert2("Sorry, file of this name already exists .",'danger');
    $uploadOk = 0;
  }

  // Check file size
  else if ($_FILES["fileToUpload"]["size"] > 2000000) {
   alert2("Sorry, your file is too large.",'danger');
    $uploadOk = 0;
  }

  // Allow certain file formats
  else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    alert2("Sorry, only JPG, JPEG, PNG & GIF files are allowed.",'danger');
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  else if ($uploadOk == 0) {
    alert2("Sorry, your file was not uploaded.",'danger');
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      require_once('include/db.php');
      $query=$db->prepare('INSERT INTO courses (c_heading, c_rfee, c_fee, c_desc, c_duration, c_addedby, date, image) VALUES (?,?,?,?,?,?,?,?);');
      $query->execute(array(
        $c_heading,
        $c_crfee,
        $c_cfee,
        $c_desc,
        $c_duration,
        $c_addedby,
        $date,
        $image
      ));
      alert2('Course Added Sucessfully','success');
      header( "refresh:1;url=view_courses.php" );
    } else {
      alert2("Sorry, there was an error in uploading data",'danger');
    }
  }
}
?>


  <div class="add-course">
    <h2 class="text-center">Add Course</h2>
    <form action="add_course.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="formFile" class="form-label">Featured Image</label>
        <input class="form-control" name="fileToUpload" type="file">
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_heading" placeholder="Course Heading">
        <label for="floatingInput">Course Heading</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_rfee" placeholder="Course Registration Fee">
        <label for="floatingInput">Course Registration Fee <i class="fa-solid fa-indian-rupee-sign"></i></label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="c_fee" placeholder="Course Fee">
        <label for="floatingInput">Course Fee <i class="fa-solid fa-indian-rupee-sign"></i></label>
      </div>
      <div class="form-floating mb-3">
        <textarea class="form-control" name="c_desc" placeholder="Course Description" style="height: 350px"></textarea>
        <label for="floatingTextarea">Course Description</label>
      </div>
      <div class="form-floating mb-3">
        <select class="form-select" name="c_duration" id="floatingSelect" aria-label="Floating label select example">
          <option selected>Select</option>
          <option value="1">One Month</option>
          <option value="2">Two Months</option>
          <option value="3">Three Months</option>
          <option value="4">Four Months</option>
          <option value="5">Five Months</option>
          <option value="6">Six Months</option>
        </select>
        <label for="floatingSelect">Course Duration</label>
      </div>
      <button type="submit" class="btn"><i class="fa-solid fa-circle-plus"></i> Sumbit</button>
    </form>
  </div>
  <?php include 'include/footer.php';?>
</body>

</html>