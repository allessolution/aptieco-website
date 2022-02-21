<!-- session check -->
<?php 
  session_start();
  if (isset($_SESSION['user'])) {
    header('location:dashboard.php');
  }
?>
<?php include "include/header.php"?>
<body>
<?php include "include/nav.php"?>
<div class="form">
  <div class="col-lg-4 col-md-6 col-sm-12">
    <form action="./" method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="pwd" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
<?php include "include/footer.php"?>
</body>
</html>
<?php
require_once 'include/db.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  include 'include/functions.php';
  if (empty($_POST['username']) or empty($_POST['pwd'])) {
    alert('All fields are required');
  }
  else {
    require_once 'include/db.php';
    $query=$db->prepare('SELECT * from admin where username=? and password=?');
    $query->execute(array(
      $_POST['username'],
      md5($_POST['pwd'])
    ));
    $data=$query->fetchall();
    $count= count($data);
    if ($count>0) {
      $_SESSION['user']=$data[0]['type'];
      $_SESSION['username']=$data[0]['username'];
      header('location:dashboard.php');
    } else {
      alert('Wrong Username or Password');
    }
  }
  
}
?>