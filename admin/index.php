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
        <h2 class="text-center">Admin Login</h2>
        <div class="form-floating mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="pwd" class="form-control" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
      <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</button>
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
    alert('All fields are required','danger');
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
      alert('Login Sucuessfully!','success');
      header( "refresh:1;url=dashboard.php" );
    } else {
      alert('Wrong Username or Password','danger');
    }
  }
  
}
?>