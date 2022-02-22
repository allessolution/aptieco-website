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
</script>
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
                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php $sno=$sno+1; }?>
            </tbody>
        </table>
    </div>
    <?php include 'include/footer.php';?>
</body>
</html>