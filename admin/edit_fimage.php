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
if (isset($_GET['f_image'])) {
    $f_image=$_GET['f_image'];
}
else {
    $f_image=$_POST['f_image'];
}
$query=$db->prepare('SELECT * from courses where id=?');
$query->execute(array(
    $f_image
));
$data=$query->fetch();
?>
<body>
    <?php include 'include/nav.php';?>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
  include 'include/functions.php';
  $target_dir = "../assets/image/courses/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $target_del='../assets/image/courses/'.$data['image'];
  $move_del_dir='../assets/image/trash/';
  $uploadOk = 1;
  $image=$_FILES["fileToUpload"]["name"];
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (empty($image)  ) {
    alert2('No File Selected','danger');
  }
  // Check if file already exists
  else if (file_exists($target_file)) {
    alert2("Sorry, file of this name already exists .",'danger');
    $uploadOk = 0;
  }

  // Check file size
  else if ($_FILES["fileToUpload"]["size"] > 2000000) {
   alert2("File size should be less than 2mb.",'danger');
    $uploadOk = 0;
  }

  // Allow certain file formats
  else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "webp" ) {
    alert2("Sorry, only JPG, JPEG, PNG, WEBP & GIF files are allowed.",'danger');
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  else if ($uploadOk == 0) {
    alert2("Sorry, your file was not uploaded.",'danger');
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) and rename($target_del, $move_del_dir . pathinfo($target_del, PATHINFO_BASENAME))) {
      require_once('include/db.php');
      $query=$db->prepare('UPDATE courses SET image=? where id=?');
      $query->execute(array(
        $image,
        $f_image
      ));
      alert2('Featured Image Updated Sucessfully','success');
      header( "refresh:1;url=courses.php" );
    } else {
      alert2("Sorry, there was an error in uploading data",'danger');
    }
  }
}
?>
    <center>
            <h2>Edit Featured Image</h2>
        </center>
        <div class="form">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card" style="width: 100%; align-items:center;">
                <img src="../assets/image/courses/<?php echo $data['image']; ?>" class="card-img-top" alt="...">
                <form action="edit_fimage.php" method="POST" enctype="multipart/form-data" style="text-align: center;">
                    <div class="mb-4 mt-4" style="margin:0px 10px">
                        <input class="form-control" name="fileToUpload" type="file">
                    </div>
                        <button type="submit" class="btn mb-3"><i class="fa-solid fa-pen-to-square"></i> Change Image</button>
                    </div>
                    <input type="text" name="f_image" value="<?php echo $data['id'] ?>" hidden>
                </form>
            </div>
        </div>
   <?php include 'include/footer.php';?>