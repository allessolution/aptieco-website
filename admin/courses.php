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
?>
<script>
    function edit(sno) {
        window.location.href="edit_courses.php?edit="+sno
    }
    function del(sno) {
        if (confirm('Do you Really Want to delete?')) {
            window.location.href="courses.php?del="+sno
        }
    }
</script>
<?php 
    if (isset($_GET['del'])) {
        $query=$db->prepare('DELETE from courses where id=?');
        $query->execute(array(
            $_GET['del']
        ));
        header('location:courses.php');
    }
?>
<body>
    <?php include 'include/nav.php';?>
    <div class="table-responsive custom-table">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">S.no</th>
                <th scope="col">Course Heading</th>
                <th scope="col">Added By</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno=1;
                while ($data=$query->fetch()) { ?>
                    <tr>
                        <th scope="row"><?php echo $sno; ?></th>
                        <td><?php echo $data['c_heading'] ?></td>
                        <td><?php echo $data['c_addedby'] ?></td>
                        <td>
                            <button class="btn" onclick=edit(<?php echo $data['id'] ?>)><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-danger" onclick=del(<?php echo $data['id'] ?>)><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php $sno=$sno+1; }?>
            </tbody>
        </table>
    </div>
    <?php include 'include/footer.php';?>
</body>
</html>