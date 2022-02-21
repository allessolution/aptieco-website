<?php include "include/header.php"?>
<?php 
require_once 'include/db.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
}
?>
<body>
<?php include "include/nav.php"?>
<div class="form">
<form action="index.php" method="POST">
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php include "include/footer.php"?>
</body>
</html>