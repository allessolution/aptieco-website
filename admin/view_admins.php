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
$query=$db->query('SELECT * from admin');
?>
<script>
    function edit(sno) {
        window.location.href="edit_admin.php?edit="+sno
    }
    function del(sno) {
        if (confirm('Do you Really Want to delete?')) {
            window.location.href="view_admins.php?del="+sno
        }
    }
</script>
<?php 
    if (isset($_GET['del'])) {
        $query=$db->prepare('DELETE from admin where id=?');
        $query->execute(array(
            $_GET['del']
        ));
        header('location:view_admins.php');
    }
?>
<body>
    <?php include 'include/nav.php';?>
    <div class="table-responsive custom-table">
        <center>
            <h2>All Admins</h2>
            <a href="add_admin.php"><button class="btn">Add New Admin</button></a>
        </center>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">S.no</th>
                <th scope="col">Username</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno=1;
                while ($data=$query->fetch()) { ?>
                    <tr>
                        <th scope="row"><?php echo $sno; ?></th>
                        <td><?php echo $data['username'] ?></td>
                        <td><?php echo $data['type'] ?></td>
                        <?php if ($data['id']!=1) { ?>
                            <td>
                                <a style="font-size:1.6rem; color:#00a1ff;" onclick=edit(<?php echo $data['id'] ?>)><i class="fa-solid fa-pen-to-square"></i></a>&nbsp; &nbsp;
                                <a style="font-size:1.6rem; color:red;" onclick=del(<?php echo $data['id'] ?>)><i class="fa-solid fa-trash"></i></a>
                            </td>
                        <?php }?>
                    </tr>
                <?php $sno=$sno+1; }?>
            </tbody>
        </table>
    </div>
    <?php include 'include/footer.php';?>