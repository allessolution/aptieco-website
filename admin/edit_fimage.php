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
$query=$db->prepare('SELECT * from courses where id=?');
if (isset($_GET['f_image'])) {
    $f_image=$_GET['f_image'];
}
else {
    $f_image=$_POST['f_image'];
}
$query->execute(array(
    $f_image
));
$data=$query->fetch();
?>
<body>
    <?php include 'include/nav.php';?>
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