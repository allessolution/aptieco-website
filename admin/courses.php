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
    function featured(sno) {
        window.location.href="courses.php?feature="+sno
    }
    function nofeatured(sno) {
        window.location.href="courses.php?remove_feature="+sno
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
    if (isset($_GET['feature'])) {
        $query=$db->prepare('UPDATE courses SET featured=1 where id=?');
        $query->execute(array(
            $_GET['feature']
        ));
        header('location:courses.php');
    }
    if (isset($_GET['remove_feature'])) {
        $query=$db->prepare('UPDATE courses SET featured=0 where id=?');
        $query->execute(array(
            $_GET['remove_feature']
        ));
        header('location:courses.php');
    }
?>
<body>
    <?php include 'include/nav.php';?>
    <div class="table-responsive custom-table">
        <center>
            <h2>All Courses</h2>
            <a href="add_course.php"><button class="btn">Add New Course</button></a>
        </center>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">S.no</th>
                <th scope="col">Course Heading</th>
                <th scope="col">Added By</th>
                <th scope="col">Featured</th>
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
                            <?php if ($data['featured']==0) {?>
                                <a style="font-size:1.6rem; color:red;" onclick=featured(<?php echo $data['id'] ?>)><i class="fa-solid fa-toggle-off"></i></a>
                            <?php } ?>
                            <?php if ($data['featured']==1) {?>
                                <a style="font-size:1.6rem; color:limegreen;" onclick=nofeatured(<?php echo $data['id'] ?>)><i class="fa-solid fa-toggle-on"></i></a>
                            <?php } ?>
                        </td>
                        <td>
                            <a style="font-size:1.6rem; color:#00a1ff;" onclick=edit(<?php echo $data['id'] ?>)><i class="fa-solid fa-pen-to-square"></i></a>&nbsp; &nbsp;
                            <a style="font-size:1.6rem; color:red;" onclick=del(<?php echo $data['id'] ?>)><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php $sno=$sno+1; }?>
            </tbody>
        </table>
    </div>
    <?php include 'include/footer.php';?>